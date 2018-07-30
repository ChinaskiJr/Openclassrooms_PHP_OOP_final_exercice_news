<?php
namespace OCFram;

// Start the session's system here, it will be launched as soon as the autoload will include this file.
session_start();

/**
 * Store every informations about the user in a session system. 
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
class User extends ApplicationComponent {
	 /**
	  * If exists, get the user attribute in $_SESSION.
	  * @param mixed $attr
	  * @return mixed
	  */
	public function getAttribute($attr) {
		return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
	}
	/**
	 * If exists, get $_SESSION['flash'] and unset it. 
	 * @return string
	 */
	public function getFlash() {
		$flash = $_SESSION['flash'];
		unset($_SESSION['flash']);
		return $flash;
	}
	/**
	 * Check if $_SESSION['flash'] is set.
	 * @return bool 
	 */
	public function hasFlash() {
		return isset($_SESSION['flash']);
	}
	/**
	 * Check if the user is authenticated.
	 * @return bool
	 */
	public function isAuthenticated() {
		return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
	}
	/**
	 * Set an attribute in $_SESSION.
	 * @param mixed $attr
	 * @param mixed $value
	 * @return void
	 */
	public function setAttribute($attr, $value) {
		$_SESSION[$attr] = $value;
	}
	/**
	 * Set the authenticated boolean in $_SESSION.
	 * @param bool $auth true by default.
	 */
	public function setAuthenticated($auth = true) {
		if (!is_bool($auth)) {
			throw new \InvalidArgumentException('The value specified to the method User::setAuthenticated() must be a boolean');
		}
		$_SESSION['auth'] = $auth;
	}
	/**
	 * Set a value to $_SESSION['flash'].
	 * @param string $value
	 * @return void
	 */
	public function setFlash($value) {
		$_SESSION['flash'] = $value;
	}
}