<?php
namespace App\Backend;
use OCFram\Application;

/**
 * Backend Application.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668899-le-backend
 * @version 1.0
 */
class BackendApplication extends Application {
    /**
     * BackendApplication constructor.
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->name = 'Backend';
    }
    public function run() {
        if ($this->user->isAuthenticated()) {
            $controller = $this->getController();
        } else {
            $controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'index');
        }

        $controller->execute();

        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }
}