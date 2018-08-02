<?php
namespace App\Backend\Modules\News;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
/**
 * Controller of Backend News module
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668899-le-backend
 * @version 1.0
 */
class NewsController extends BackController {
    /**
     * Send to the view the list of the news and their count.
     * @param HTTPRequest $request
     * @return void
     */
    public function executeIndex(HTTPRequest $request) {
        $this->page->addVar('title', 'News management');
        $manager = $this->managers->getManagerOf('News');
        $this->page->addVar('listNews', $manager->getList());
        $this->page->addVar('nbNews', $manager->count());
    }
}