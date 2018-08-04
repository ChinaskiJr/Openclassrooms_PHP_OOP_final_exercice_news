<?php

namespace OCFram;

/**
 * Form with 'input' fields.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1669084-gerer-les-formulaires
 * @version 1.0
 */
class StringField extends Field {
    protected $maxLenght;

    /**
     * Write the html form (<label> + <input>)
     * @return string
     */
    public function buildWidget() {
        $widget = '';
        if (!empty($this->errorMessage)) {
            $widget .= $this->errorMessage . '<br />';
        }
        $widget .= '<label for="' . $this->name . '">' . $this->label . '</label>';
        $widget .= '<input type ="text" id="' . $this->name . '" name="' . $this->name . '"';
        if (!empty($this->value)) {
            $widget .=  'value="' . htmlspecialchars($this->value) . '"';
        }
        if (!empty($this->maxLenght)) {
            $widget .= ' maxlength ="' . $this->maxLenght . '"';
        }
        return $widget .= ' />';
    }

    /**
     * Setter for $maxLenght
     * @param mixed $maxLenght
     */
    public function setMaxLenght($maxLenght) {
        $maxLenght = (int) $maxLenght;
        if ($maxLenght > 0) {
            $this->maxLenght = $maxLenght;
        } else {
            throw new \InvalidArgumentException('The max length must not be lower than 0');
        }
    }
}