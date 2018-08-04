<?php
namespace App\Backend\Modules\News;

use Entity\Comment;
use \Entity\News;
use FormBuilder\CommentFormBuilder;
use FormBuilder\NewsFormBuilder;
use \OCFram\BackController;
use OCFram\FormHandler;
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
        $this->processForm($request);
    }

    /**
     * Send to the view the form adapted to the Update action.
     * @param HTTPRequest $request
     */
    public function executeUpdate(HTTPRequest $request) {
        // Title
        $this->page->addVar('title', 'Update a news');
        $this->processForm($request);
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
            $this->managers->getManagerOf('Comments')->deleteFromNews($news->id());
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
        if ($request->method() == 'POST') {
            $news = new News ([
                'author' => $request->postData('author'),
                'title' => $request->postData('title'),
                'content' => $request->postData('content')
            ]);
            if ($request->getExists('id')) {
                $news->setId($request->getData('id'));
            }
        } else {
            if ($request->getExists('id')) {
                $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
            } else {
                $news = new News;
            }
        }
        $formBuilder = new NewsFormBuilder($news);
        $formBuilder->build();
        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('News'), $request);
        if ($formHandler->process()) {
            $this->app->user()->setFlash($news->isNew() ? 'The news had been posted !' : 'The news had been updated !');
            $this->app->httpResponse()->redirect('/admin/');
        }
        $this->page->addVar('form', $form->createView());
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
                'id' => $request->getData('id'),
                'author' => $request->postData('author'),
                'content' => $request->postData('content')
            ]);
        } else {
            $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
        }

        $formBuilder = new CommentFormBuilder($comment);
        $formBuilder->build();
        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
        if ($formHandler->process()) {
            $this->app->user()->setFlash('The comment had been edited');
            $this->app->httpResponse()->redirect('/admin/');
        } else {
            $this->page->addVar('errors', $comment->errors());
        }
        $this->page->addVar('form', $form->createView());
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