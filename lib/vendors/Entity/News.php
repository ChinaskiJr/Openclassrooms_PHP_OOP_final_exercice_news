<?php

namespace Entity;

use \OCFRAM\Entity;

/**
 * News will be instances of this class.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
class News extends Entity {
    protected $author;
    protected $title;
    protected $content;
    protected $dateAdd;
    protected $dateEdit;

    const INVALID_AUTHOR;
    const INVALID_TITLE;
    const INVALID_CONTENT;

    /**
     * Check if all the field of the News had been filled.
     * @return bool
     */
    public function isValid() {
        return !(empty($author) || empty($title) || empty($content));
    }

    // SETTERS
    /**
     * Setter for $author.
     * @param string $author
     */
    public function setAuthor($author) {
        if (!is_string($author) || empty($author)) {
            $this->errors[] = self::INVALID_AUTHOR;
        }
        $this->author = $author;
    }
    /**
     * Setter for $title.
     * @param string $title
     */
    public function setTitle($title) {
        if (!is_string($title) || empty($title)) {
            $this->errors[] = self::INVALID_TITLE;
        }
        $this->title = $title;
    }
    /**
     * Setter for $content.
     * @param string $content
     */
    public function setContent($content) {
        if (!is_string($content) || empty($content)) {
            $this->errors[] = self::INVALID_CONTENT;
        }
        $this->content = $content;
    }
    /**
     * Setter for $dateAdd.
     * @param \DateTime $dateAdd
     */
    public function setDateAdd(\DateTime $dateAdd) {
        $this->dateAdd = $dateAdd;
    }
    /**
     * Setter for $dateEdit.
     * @para \DateTime $dateEdit
     */
    public function setDateEdit(\DateTime $dateEdit) {
        $this->dateEdit = $dateEdit;
    }

    // GETTERS
    /**
     * Getter of $author.
     * @return string
     */
    public function getAuthor() {
        return $this->author;
    }
    /**
     * Getter of $title.
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }
    /**
     * Getter of $content.
     * @return string
     */
    public function getContent() {
        return $this->content;
    }
    /**
     * Getter of $dateAdd.
     * @return \DateTime
     */
    public function getDateAdd() {
        return $this->dateAdd;
    }
    /**
     * Getter of $dateEdit.
     * @return \DateTime
     */
    public function getDateEdit() {
        return $this->dateEdit;
    }




}