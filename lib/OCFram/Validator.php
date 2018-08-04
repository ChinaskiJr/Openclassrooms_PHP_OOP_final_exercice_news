<?php

namespace OCFram;

/**
 * Abstract class from whom different validators will inherit from.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1669084-gerer-les-formulaires
 * @version 1.0
 */
abstract class Validator {
    protected $errorMessage;

    /**
     * Validator constructor.
     * @param $errorMessage
     * @return void
     */
    public function __construct($errorMessage) {
        $this->setErrorMessage($errorMessage);
    }

    /**
     * Check if the field is valid.
     * @param string $value
     * @return bool
     */
    abstract public function isValid($value);

    /**
     * Getter for $errorMessage.
     * @return string
     */
    public function errorMessage() {
        return $this->errorMessage;
    }

    /**
     * Setter for $errorMessage.
     * @param $errorMessage
     */
    public function setErrorMessage($errorMessage) {
        if (!is_string($errorMessage)) {
            throw new \InvalidArgumentException('The error message must be a string.');
        }
        $this->errorMessage = $errorMessage;
    }
}