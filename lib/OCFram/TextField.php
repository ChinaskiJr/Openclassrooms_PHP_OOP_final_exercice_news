<?php

namespace OCFram;

/**
 * Form with 'textarea' fields.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1669084-gerer-les-formulaires
 * @version 1.0
 */
class TextField extends Field {
    protected $rows;
    protected $cols;

    public function buildWidget() {
        $widget = '';
        if (!empty($this->errorMessage)) {
            $widget .= $this->errorMessage . '<br />';
        }
        $widget .= '<label for="' . $this->name . '">' . $this->label . '</label>';
        $widget .= '<textarea id="' . $this->name . '" name="' . $this->name . '"';
        if (!empty($this->cols)) {
            $widget .= ' cols=" ' . $this->cols . '"';
        }
        if (!empty($this->rows)) {
            $widget .= ' rows="' . $this->rows . '">';
        }
        if (!empty($this->value)) {
            $widget .= htmlspecialchars($this->value);
        }
        return $widget .= '</textarea>';
    }

    /**
     * Setter for $rows
     * @param int $rows
     */
    public function setRows($rows) {
        $rows = (int) $rows;
        if ($rows > 0) {
            $this->rows = $rows;
        } else {
            throw new \InvalidArgumentException('The rows value must be more than 0');
        }
    }

    /**
     * Setter for $cols
     * @param int $cols
     */
    public function setCols($cols) {
        $cols = (int) $cols;
        if ($cols > 0) {
            $this->cols = $cols;
        } else {
            throw new \InvalidArgumentException('The cols value must be more than 0');
        }
    }
}