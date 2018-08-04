<?php

namespace OCFram;

/**
 * Validator for maximum length of a string.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1669084-gerer-les-formulaires
 * @version 1.0
 */
class MaxLengthValidator extends Validator {
    protected $maxLength;

    /**
     * MaxLengthValidator constructor.
     * @param string $errorMessage
     * @param int $maxLength
     * @return void
     */
    public function __construct($errorMessage, $maxLength) {
        parent::__construct($errorMessage);
        $this->setMaxLength($maxLength);
    }

    /**
     * Check if the string tested validate the maximum length.
     * @see Validator
     * @param string $value
     * @return bool
     */
    public function isValid($value) {
        return strlen($value) <= $this->maxLength;
    }

    /**
     * Setter for $maxLength.
     * @param $maxLength
     */
    public function setMaxLength($maxLength) {
        $maxLength = (int) $maxLength;
        if ($maxLength < 0) {
            throw new \RuntimeException('The maximum length must be greater than 0');
        } else {
            $this->maxLength = $maxLength;
        }
    }
}