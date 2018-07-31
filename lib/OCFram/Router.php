<?php

namespace OCFram;
/**
 * Get a Route and can return the Rouge requested by the URL.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
class Router {
	protected $routes = [];
	const NO_ROUTE = 1;

	/**
	 * Add a route in the object attribute.
	 * @param Route $route
	 * @return void
	 */
	public function addRoute(Route $route) {
		if (!in_array($route, $this->routes)) {
			$this->routes[] = $route;
		}
	}
	/**
	 * Returns the route that match with the URL
	 * @param string $url
	 * @return Route const
	 */
	public function getRoute($url) {
        foreach($this->routes as $route) {
            // If the route feets to the URL
            if (($varsValues = $route->match($url)) !== false) {
                // If it has variables
                if ($route->hasVars()) {
                    $varsNames = $route->varsNames();
                    $listVars = [];
                    // $key = name of the variables | $value = his value
                    foreach ($varsValues as $key => $match) {
                        if ($key !== 0) {
                            $listVars[$varsNames[$key - 1]] = $match;
                        }
                    }
                    $route->setVars($listVars);
                }

                return $route;
            }
        }
        throw new \RuntimeException('None of the roads feets to the URL', self::NO_ROUTE);
    }
}