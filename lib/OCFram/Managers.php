<?php
namespace OCFram;
/**
 * Link the managers (daughter of this) to the controller.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
class Managers {
	protected $api = null;
	protected $dao = null;
	protected $managers = [];

	/**
	 * Constructor of the class
	 * @param string $api
	 * @param object $dao
	 * @return void
	 */
	public function __construct($api, $dao) {
		$this->api = $api;
		$this->dao = $dao;
	}

	public function getManagerOf($module) {
		if (!is_string($module) || empty($module)) {
			throw new \InvalidArgumentException('The module must be a non-empty string');
		}
		if (!isset($this->managers[$module])) {
			$manager = '\\Model\\' . $module . 'Manager' . $this->api;
			$this->managers[$module] = new $manager($this->dao);
		}
		return $this->managers[$module];
	}
}