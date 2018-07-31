<?php

namespace Entity;

use \OCFram\Entity;

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

    const INVALID_AUTHOR = 1;
    const INVALID_TITLE = 2;
    const INVALID_CONTENT = 3;

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
     * @param \DateTime $dateEdit
     */
    public function setDateEdit(\DateTime $dateEdit) {
        $this->dateEdit = $dateEdit;
    }

    // GETTERS
    /**
     * Getter of $author.
     * @return string
     */
    public function Author() {
        return $this->author;
    }
    /**
     * Getter of $title.
     * @return string
     */
    public function Title() {
        return $this->title;
    }
    /**
     * Getter of $content.
     * @return string
     */
    public function Content() {
        return $this->content;
    }
    /**
     * Getter of $dateAdd.
     * @return \DateTime
     */
    public function DateAdd() {
        return $this->dateAdd;
    }
    /**
     * Getter of $dateEdit.
     * @return \DateTime
     */
    public function DateEdit() {
        return $this->dateEdit;
    }
}