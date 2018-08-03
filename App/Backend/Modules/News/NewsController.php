<?php
namespace App\Backend\Modules\News;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\News;
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
    public function executeInsert(HTTPRequest $request) {
        // Title
        $this->page->addVar('title', 'Post a news');
        if ($request->postExists('content')) {
            $this->processForm($request);
        }
    }
    public function processForm(HTTPRequest $request) {
        $news = new News ([
            'author' => $request->postData('author'),
            'title' => $request->postData('title'),
            'content' => $request->postData('content')
        ]);
        if ($request->postExists('id')) {
            $news->setId($request->postData('id'));
        }
        if ($news->isValid()) {
            $this->managers->getManagerOf('News')->save($news);
            $this->app->user()->setFlash($news->isNew() ? 'The news had been posted !' : 'The news had been updated !');
        } else {
            $this->page->addVar('errors', $news->errors());
        }
        $this->page->addVar('news', $news);
    }
}