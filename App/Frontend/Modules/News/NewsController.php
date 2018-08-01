<?php
namespace App\Frontend\Modules\News;
use \OCFram\BackController;
use \OCFram\HTTPRequest;

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
    }
}