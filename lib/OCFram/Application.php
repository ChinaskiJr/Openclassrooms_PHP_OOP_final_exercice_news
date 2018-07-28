<?php

namespace OCFram;
/**
 * The abstract class  whom every class that represent an application will herit from.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
abstract class Application {
	/**
	 * @var An instance of HTTPRequest.
	 */
	protected $httpRequest;
	/**
	 * @var An instance of HTTPResponse.
	 */
	protected $httpResponse;
	protected $name;

	/**
	 * The constructor of the class. 
	 * Instanciate the class HTTPRequest and HTTPReponse.
	 * Set name to empty string cause daughters class will re-assignate it.
	 * @return void
	 */
	public function __construct() {
		$this->httpRequest = new HTTPRequest;
		$this->httpResponse = new HTTPResponse;
		$this->name = ' ';
	}
	/**
	 * @see Daughters class
	 */
	abstract public function run();
	/**
	 * Getter of $httpRequest.
	 * @return HTTPRequest $httpRequest
	 */
	public function httpRequest() {
		return $this->httpRequest;
	}
	/**
	 * Getter of $httpResponse.
	 * @return HTTPResponse $httpResponse
	 */
	public function httpResponse() {
		return $this->httpResponse;
	}
	/**
	 * Getter of $name.
	 * @return string $name
	 */
	public function name() {
		return $this->name();
	}
}