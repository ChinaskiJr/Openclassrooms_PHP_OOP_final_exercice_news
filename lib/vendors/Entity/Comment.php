<?php

namespace Entity;
use \OCFram\Entity;

/**
 * Comments will be instances of this class.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */

class Comment extends Entity {
    protected $id;
    protected $news;
    protected $author;
    protected $content;
    protected $date;

    const INVALID_AUTHOR = 1;
    const INVALID_COMMENT = 2;

    /**
     * Getter of $news
     * @return int
     */
    public function news() {
        return $this->news;
    }
    /**
     * Setter of $news
     * @param mixed $news
     */
    public function setNews($news) {
        $this->news = (int) $news;
    }
    /**
     * Getter of $author
     * @return string
     */
    public function author() {
        return $this->author;
    }
    /**
     * Setter for $author
     * @param string $author
     */
    public function setAuthor($author) {
        if (!is_string($author) || empty($author)) {
            $this->errors[] = self::INVALID_AUTHOR;
        }
        $this->author = $author;
    }
    /**
     * Getter of $content
     * @return string
     */
    public function Content() {
        return $this->content;
    }
    /**
     * Setter of $content
     * @param string $content
     */
    public function setContent($content) {
        if (!is_string($content) || empty($content)) {
            $this->errors[] = self::INVALID_COMMENT;
        }
        $this->content = $content;
    }
    /**
     * Getter of $date
     * @return DateTime
     */
    public function Date() {
        return $this->date;
    }

    /**
     * Setter of $date
     * @param DateTime $date
     */
    public function setDate(\DateTime $date) {
        $this->date = $date;
    }

    /**
     * Check if the two fields of the object are filled.
     * @return bool
     */
    public function isValid() {
        return !(empty($this->author) || empty($this->content));
    }
}