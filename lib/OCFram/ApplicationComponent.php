<?php

namespace OCFram;
/**
 * Stock the instance of the application executed during the instanciation of the object.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
 abstract class ApplicationComponent {
 	/**
 	 * @var Application
 	 */
 	protected $app;
 	/**
 	 * Constructor of the class
 	 * @param Application $app
 	 * @return void
 	 */
 	public function __construct(Application $app) {
 		$this->app = $app;
 	}
 	/**
 	 * Getter of $app
 	 * @return Application const;
 	 */
 	public function app() {
 		return $this->app;
 	}
 }