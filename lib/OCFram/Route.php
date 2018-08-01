<?php
namespace OCFram;
/**
 * Every instance of this class will represent a route possible match to send to Router.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
class Route {
	protected $action;
	protected $module;
	protected $url;
	protected $varsNames;
	protected $vars = [];
	const INVALID_ARGUMENT = 2;
	/**
	 * Constructor of the class. Just calls the setters.
	 * @param string $url
	 * @param string $module
	 * @param string $action
	 * @param array $varsNames
	 * @return void
	 */
	public function __construct($url, $module, $action, array $varsNames) {
		$this->setUrl($url);
		$this->setModule($module);
		$this->setAction($action);
		$this->setVarsNames($varsNames);
	}
	/**
	 * Check if $vars array is empty.
	 * @return bool const
	 */
	public function hasVars() {
		return !empty($this->varsNames);
	}
	/**
	 * Check if $url feets to website URL.
	 * @param string $url
	 * @return bool const
	 */
	public function match($url) {
		if (preg_match('`^' . $this->url . '$`', $url, $matches)) {
			return $matches;
		} else {
			return false;
		}
	}
	/**
	 * Setters of $action.
	 * @param string $action
	 * @return void
	 */
	public function setAction($action) {
		if (is_string($action)) {
			$this->action = $action;
		} else {
			throw new \InvalidArgumentException('Action must be a string', self::INVALID_ARGUMENT);
		}
	}
	/**
	 * Setter of $module.
	 * @param string $module
	 * @return void
	 */
	public function setModule($module) {
		if (is_string($module)) {
			$this->module = $module;
		} else {
			throw new \InvalidArgumentException('Module must be as string', self::INVALID_ARGUMENT);
		}
	}
	/**
	 * Setter of $url.
	 * @param string $url
	 * @return void
	 */
	public function setUrl($url) {
		if (is_string($url)) {
			$this->url = $url;
		} else {
			throw new \InvalidArgumentException('URL must be a string', self::INVALID_ARGUMENT);
		}
	}
	/**
	 * Setter of $varsNames.
	 * @param array $varsNames
	 * @return void
	 */
	public function setVarsNames(array $varsNames) {
		$this->varsNames = $varsNames;
	}
	/**
	 * Setter of $vars.
	 * @param array $vars
	 * @return void
	 */
	public function setVars(array $vars) {
		$this->vars = $vars;
	}
	/**
	 * Getter of $action.
	 * @return string $action
	 */
	public function action() {
		return $this->action;
	}
	/**
	 * Getter of $module.
	 * @return string $module
	 */
	public function module() {
		return $this->module;
	}
	/**
	 * Getter of $url.
	 * @return string $url
	 */
	public function url() {
		return $this->url;
	}
	/**
	 * Getter of $varsNames.
	 * @return array $varsNames
	 */
	public function varsNames() {
		return $this->varsNames;
	}
	/**
	 * Getter of $vars.
	 * @return array $vars
	 */
	public function vars() {
		return $this->vars;
	}
	
}