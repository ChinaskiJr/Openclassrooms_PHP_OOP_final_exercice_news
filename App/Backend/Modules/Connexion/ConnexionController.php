<?php
namespace App\Backend\Modules\Connexion;
use \OCFram\BackController;
use \OCFram\HTTPRequest;

/**
 * Controller of Connexion module
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668899-le-backend
 * @version 1.0
 */
class ConnexionController extends BackController {
    /**
     * Check if password and login match in the XML file
     * TODO : ENCRYPT PASSWORD
     * @param HTTPRequest $request
     * @return void
     */
    public function executeIndex(HTTPRequest $request) {
        // Title
        $this->page->addVar('title', 'Connexion');
        if ($request->postExists('login')) {
            $login = $request->postData('login');
            $password = $request->postData('password');

            if ($login == $this->app->config()->get('login') && $password == $this->app->config()->get('password')) {
                $this->app->user()->setAuthenticated(true);
                $this->app->httpResponse()->redirect('.');
            } else {
                $this->app->user()->setFlash('The password or the login (or maybe both) is incorrect');
            }
        }
    }
}