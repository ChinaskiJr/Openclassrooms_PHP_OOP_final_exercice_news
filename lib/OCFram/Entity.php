<?php
namespace OCFram;

/**
 * Abstract class that represents en entity from the database.
 * Implements the interface ArrayAccess.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
 abstract class Entity implements \ArrayAccess {
 	protected $errors = [];
 	protected $id;

 	/**
 	 * Constructor of the class
 	 * @param array $data
 	 * @return void
 	 */
 	public function __construct(array $data) {
 		if (!empty($data)) {
 			$this->hydrate($data);
 		}
 	}
 	/**
 	 * Hydrate the object with the datas
 	 * @param array $data
 	 * @return void
 	 */
 	public function hydrate(array $data) {
 		foreach ($data as $key => $value) {
 			$method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
 			}
 		}
 	}
 	/**
 	 * Check if the record is new. 
 	 * @return bool
 	 */
 	public function isNew() {
 		return empty($this->id);
 	}
 	/**
 	 * Getter of $errors.
 	 * @return array $errors
 	 */
 	public function errors() {
 		return $this->errors;
 	}
 	/**
 	 * Getter of $id.
 	 * @return int $id
 	 */
 	public function id() {
 		return $this->id;
 	}
 	/**
 	 * Setter of $id
     * @param int $id
 	 */
 	public function setId($id) {
 		$this->id = (int) $id;
 	}

 	// Array Access Interface methods
 	public function offsetExists($var) {
 		return isset($this->$var) && is_callable([$this, $var]);
 	}
 	public function offsetGet($var) {
 		if (isset($this->$var) && is_callable([$this, $var])) {
 			return $this->$var();
 		}
 	}
 	public function offsetSet($var, $value) {
 		$method = 'set' . ucfirst($var);
 		if (isset($this->$var) && is_callable([$this, $var])) {
 			$this->$method($value);
 		}
 	}
 	public function offsetUnset($var) {
 		throw new \Exception('Impossible to delete a value');
 	}

 }