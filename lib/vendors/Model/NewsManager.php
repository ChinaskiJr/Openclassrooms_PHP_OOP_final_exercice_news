<?php
namespace Model;
use \OCFram\Manager;
use \Entity\News;

/**
 * Class NewsManager
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668717-le-frontend
 * @version 1.0
 */
abstract class NewsManager extends Manager {
    /**
     * Get the list of the news to print in function of the configuration.
     * @param int $beginning
     * @param int $limit
     * @return array
     */
    abstract public function getList($beginning = -1, $limit = -1);

    /**
     * Get a news by his ID.
     * @param $id
     * @return News
     */
    abstract public function getUnique($id);

    /**
     * Count the news and returns the total.
     * @return int
     */
    abstract public function count();

    /**
     * Add a news to the database.
     * @param News $news
     * @return void
     */
    abstract protected function add(News $news);

    /**
     * Update a news in the database.
     * @param News $news
     * @return void
     */
    abstract protected function modify(News $news);

    /**
     * Record a news.
     * @param News $news
     * @see self::add()
     * @see self::modify()
     * @return void
     */
    public function save(News $news) {
        if ($news->isValid()) {
            $news->isNew() ? $this->add($news) : $this->modify($news);
        } else {
            throw new \RuntimeException('The news must be validated before being send');
        }
    }

    /**
     * Delete a news.
     * @param News $news
     * @return void
     */
    abstract public function delete(News $news);
}