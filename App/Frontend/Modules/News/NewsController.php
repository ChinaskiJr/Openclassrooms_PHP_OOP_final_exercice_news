<?php
namespace App\Frontend\Modules\News;
use \Entity\Comment;
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\Form;

/**
 * Class NewsController
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668717-le-frontend
 * @version 1.0
 */
class NewsController extends BackController {
    /**
     * Read the xml config file and return the index to the view.
     * @param HTTPRequest $request
     * @return void
     */
    public function executeIndex(HTTPRequest $request) {
        $nbNews = $this->app->config()->get('nb_news');
        $nbChars = $this->app->config()->get('nb_chars');
        // Title
        $this->page->addVar('title', 'List of the ' . $nbNews . ' last news');
        // Get the news manager
        $manager = $this->managers->getManagerOf('News');
        // Get the last 'nb_news'
        $listNews = $manager->getList(0, $nbNews);
        // Format the text to print only the first 'nb_chars' characters
        foreach ($listNews as $news) {
            if (strlen($news->content()) > $nbChars) {
                $beginning = substr($news->content(), 0, $nbChars);
                $beginning = substr($beginning, 0, strrpos($beginning, ' ')) . '...';
                $news->setContent($beginning);

            }
        }
        $this->page->addVar('listNews', $listNews);
    }
    /**
     * Get the ID from the request, match it with a news and send it to the view.
     * @param HTTPRequest $request
     * @return void
     */
    public function executeShow(HTTPRequest $request) {
        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
        // Redirect to 404 if there is no news
        if (empty($news)) {
            $this->app->httpResponse()->redirect404();
        }
        $this->page->addVar('title', $news->title());
        $this->page->addVar('news', $news);
        $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($news->id()));
    }

    /**
     * Check if there is a $_POST['pseudo'] var and if so et if it is valid, tells the Manager to send it to the database.
     * @param HTTPRequest $request
     * @return void
     */
    public function executeInsertComment(HTTPRequest $request) {
        $this->page->addVar('title', 'Post a comment');

        if ($request->method() == 'POST') {
            $comment = new Comment([
                'news' => $request->getData('news'),
                'author' => $request->postData('author'),
                'content' => $request->postData('content')
            ]);
        } else {
            $comment = new Comment;
        }

        $form = new Form($comment);

        $form->add(new StringField([
            'label' => 'Pseudo',
            'name' => 'author',
            'maxLength' => 50,
            'validators' => [
                new \OCFram\MaxLengthValidator('The name of the author is too long (50 characters max)', 50),
                new \OCFram\NotNullValidator('You have to fill the author field')
            ]
            ]))
            ->add(new TextField([
                'label' => 'Content',
                'name' => 'content',
                'rows' => 7,
                'cols' => 50,
            ]));
        if ($form->isValid()) {
            $this->managers->getManagerOf('Comments')->save($comment);
            $this->app->user()->setFlash('The comment had been post, thank you.');
            $this->app->httpResponse()->redirect('news-' . $request->getData('news').'.html');
        }
        $this->page->addVar('form', $form->createView());
        $this->page->addVar('comment', $comment);
    }
}