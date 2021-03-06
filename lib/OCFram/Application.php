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
	 * @var HTTPRequest
	 */
	protected $httpRequest;
	/**
	 * @var HTTPResponse
	 */
	protected $httpResponse;
	/**
	 * @var User
	 */
	protected $user;
	/**
	 * @var Config
	 */
	protected $config;
	protected $name;

	/**
	 * The constructor of the class. 
	 * Instanciate the class HTTPRequest and HTTPReponse.
	 * Set name to empty string cause daughters class will re-assignate it.
	 * @return void
	 */
	public function __construct() {
		$this->httpRequest = new HTTPRequest($this);
		$this->httpResponse = new HTTPResponse($this);
		$this->user = new User($this);
		$this->config = new Config($this);
		$this->name = ' ';
	}
	public function getController() {
		$router = new Router;
		$xml = new \DOMDocument;
		$xml->load(__DIR__ . '../../../App/' . $this->name . '/Config/routes.xml');
		$routes = $xml->getElementsByTagName('route');
		// Read the routes from the XML file
		foreach ($routes as $route) {
			$vars = [];
			// Check if there is variables in the URL
			if ($route->hasAttribute('vars')) {
				$vars = explode(',', $route->getAttribute('vars'));
			}
			// Add the route to the router
			try {
				$router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
			} catch (\InvalidArgumentException $e) {
				if ($e->getCode() == Route::INVALID_ARGUMENT) {
					$this->httpResponse->redirect404();
				}
			}
		}
		try {
			// Get the route that matches the URL
			$matchedRoute = $router->getRoute($this->httpRequest->requestURI());
		} catch (\RunTimeException $e) {
			$this->httpResponse->redirect404();
		}
		$_GET = array_merge($_GET, $matchedRoute->vars());
		// Instanciate the controller
		$controllerClass = 'App\\' . $this->name . '\\Modules\\' . $matchedRoute->module() . '\\' . $matchedRoute->module() . 'Controller';
		return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
	}
	/**
	 * @see Daughters class
	 */
	abstract public function run();
	/**
	 * Getter of $httpRequest.
	 * @return HTTPRequest
	 */
	public function httpRequest() {
		return $this->httpRequest;
	}
	/**
	 * Getter of $httpResponse.
	 * @return HTTPResponse
	 */
	public function httpResponse() {
		return $this->httpResponse;
	}
	/**
	 * Getter of $name.
	 * @return string
	 */
	public function name() {
		return $this->name;
	}

    /**
     * Getter or $user
     * @return User
     */
	public function user() {
	    return $this->user;
    }

    /**
     * Getter of $config
     * @return Config
     */
    public function config() {
	    return $this->config;
    }
}