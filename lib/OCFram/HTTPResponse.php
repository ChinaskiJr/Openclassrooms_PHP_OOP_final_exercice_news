<?php

namespace OCFram;
/**
 * The client's response will be represented as an instance of this class.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
class HTTPResponse {
	/**
	 * @var An instance of Page
	 */
	protected $page;
	/**
	 * Add a specific header to the response.
	 * @param string $header
	 * @return void
	 */
	public function addHeader($header) {
		header($header);
	}
	/**
	 * Redirect the client to a specific location.
	 * @param $string location
	 * @return void
	 */
	public function redirect($location) {
		header('Location : ' . $location);
		exit;
	}
	/** 
	 * Redirect the client to the 404 default page.
	 * @return void
	 */
	public function redirect404() {
		// WAIT FOR THE PAGE CLASS TO BE CREATED
	}
	public function send() {
		exit($this->page()->getGeneratedPage());
	}
	/**
	 * Set a cookie to send the client.
	 * @param string $name.
	 * @param string $value Optionnal. A whitespace by default.
	 * @param string $path Optionnal. null by default.
	 * @param string $domain Optionnal. null by default.
	 * @param bool $secure Optionnal. false by default.
	 * @param bool $httpOnly. Optionnal. true by default.
	 * @return void
	 */
	public function setCookie ($name, $value = ' ', $path = null, $domain = null, $secure = false, $httpOnly = true) {
		setcookie($name, $value, $path, $domain, $secure, $httpOnly);
	}
	/**
	 * Setter for $page
	 * @param Page $page
	 * @return void
	 */
	public function setPage(Page $page) {
		$this->page = $page;
	}

}