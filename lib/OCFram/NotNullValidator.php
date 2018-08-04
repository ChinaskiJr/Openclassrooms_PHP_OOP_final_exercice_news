<?php

namespace OCFram;

/**
 * Validator that checks if a value is not null.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1669084-gerer-les-formulaires
 * @version 1.0
 */
class NotNullValidator extends Validator {
    public function isValid($value) {
        return $value != '';
    }
}