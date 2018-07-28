<?php

namespace OCFram;
/**
 * The client's request will be represented as an instance of this class.
 * @version 1.0
 */
class HTTPRequest {
	/**
	 * return the data of the cookie or null if there is no cookie.
	 * @param string $key 
	 * @return string const.
	 */
	public function cookieData($key) {
		return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
	}
	/**
	 * Check if a cookie with this key does exists.
	 * @param string $key
	 * @return bool const
	 */
	public function cookieExists($key) {
		return isset($_COOKIE[$key]);
	}
	/**
	 * return the data of the GET request or null if there is no GET request.
	 * @param string $key 
	 * @return string const.
	 */
	public function getData($key) {
		return isset($_GET[$key]) ? $_GET[$key] : null;
	}
	/**
	 * Check if a GET request with this key does exists.
	 * @param string $key
	 * @return bool const
	 */
	public function getExists($key) {
		return isset($_GET[$key]);
	}
	/**
	 * return the data of the POST request or null if there is no POST request.
	 * @param string $key 
	 * @return string const.
	 */
	public function postData($key) {
		return isset($_POST[$key]) ? $_POST[$key] : null;
	}
	/**
	 * Check if a POST request with this key does exists.
	 * @param string $key
	 * @return bool const
	 */
	public function postExists($key) {
		return isset($_POST[$key]);
	}
	/** 
	 * Return the superglobal variable $_SERVER['REQUEST_METHOD']
	 * @return string const
	 */
	public function method() {
		return $_SERVER['REQUEST_METHOD'];
	}
	/** 
	 * Return the superglobal variable $_SERVER['REQUEST_URI']
	 * @return string const
	 */
	public function requestURI() {
		return $_SERVER['REQUEST_URI'];
	}
}