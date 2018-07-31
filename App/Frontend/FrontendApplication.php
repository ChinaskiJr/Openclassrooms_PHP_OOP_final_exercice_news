<?php

namespace App\Frontend;
use \OCFram\Application;
/**
 * Frontend Application.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
class FrontendApplication extends Application {
    /**
     * FrontendApplication constructor.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->name = 'Frontend';
    }
    /**
     * Get the appropriate controller, execute it, assignate the page created by it to the response and send it.
     * @return void
     */
    public function run() {
        $controller = $this->getController();
        $controller->execute();

        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }
}