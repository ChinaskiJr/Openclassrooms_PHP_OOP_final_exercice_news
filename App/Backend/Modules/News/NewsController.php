<?php
namespace App\Backend\Modules\News;

use Entity\Comment;
use \Entity\News;
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

    /**
     * Send to the view the form adapted to the Insert action.
     * @param HTTPRequest $request
     * @return void
     */
    public function executeInsert(HTTPRequest $request) {
        // Title
        $this->page->addVar('title', 'Post a news');
        if ($request->postExists('content')) {
            $this->processForm($request);
        }
    }

    /**
     * Send to the view the form adapted to the Update action.
     * @param HTTPRequest $request
     */
    public function executeUpdate(HTTPRequest $request) {
        // Title
        $this->page->addVar('title', 'Update a news');
        if ($request->postExists('content')) {
            $this->processForm($request);
        } else {
            $this->page->addVar('news', $this->managers->getManagerOf('News')->getUnique($request->getData('id')));
        }
    }

    /**
     * Send the delete Action to the manager
     * @param HTTPRequest $request
     */
    public function executeDelete(HTTPRequest $request) {
        if ($request->getExists('id')) {
            $news = new News([
                'id' => $request->getData('id')
            ]);
            $this->managers->getManagerOf('News')->delete($news);
            $this->app->user()->setFlash('The news had been deleted.');
            $this->app->httpResponse()->redirect('.');
        }
    }

    /**
     * Adapt the form to the required action.
     * @param HTTPRequest $request
     * @return void
     */
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

    /**
     * Send to the view the form to update a comment or send it to the manager.
     * @param HTTPRequest $request
     * @return void
     */
    public function executeUpdateComment(HTTPRequest $request) {
        $this->page->addVar('title', 'Edit a comment');
        if ($request->postExists('content')) {
            $comment = new Comment([
                'id' => $request->postData('id'),
                'author' => $request->postData('pseudo'),
                'content' => $request->postData('content')
            ]);

            if ($comment->isValid()) {
                $this->managers->getManagerOf('Comments')->save($comment);
                $this->app->user()->setFlash('The comment had been edited');
                $this->app->httpResponse()->redirect('/news-' . $request->postData('news') . '.html');
            } else {
                $this->page->addVar('errors', $comment->errors());
            }
            $this->page->addVar('comment', $comment);
        } else {
            $this->page->addVar('comment', $this->managers->getManagerOf('Comments')->get($request->getData('id')));
        }
    }

    public function executeDeleteComment(HTTPRequest $request) {
        if ($request->getExists('id')) {
            $comment = new Comment([
                'id' => $request->getData('id')
            ]);
            $this->managers->getManagerOf('Comments')->delete($comment->id());
            $this->app->user()->setFlash('The comment had been deleted.');
            $this->app->httpResponse()->redirect('/admin/');
        }
    }
}