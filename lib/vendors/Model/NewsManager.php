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
     * @return mixed
     */
    abstract public function getList($beginning = -1, $limit = -1);
}