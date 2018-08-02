<?php
namespace Model;
use \OCFram\Manager;

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
}