<?php

namespace OCFram;
/**
 * Represent a field that will fill the Form class.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1669084-gerer-les-formulaires
 * @version 1.0
 */

abstract class Field {

    use Hydrator;

    protected $errorMessage;
    protected $label;
    protected $name;
    protected $value;
    protected $validators = [];

    /**
     * Field constructor.
     * @param array $options Empty array by default
     */
    public function __construct($options = []) {
        if(!empty($options)) {
            $this->hydrate($options);
        }
    }

    abstract public function buildWidget();

    /**
     * Call the validators to check if the value is valid.
     * @return bool
     */
    public function isValid() {
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($this->value)) {
                $this->errorMessage = $validator->errorMessage();
                return false;
            }
        }
        return true;
    }
    // GETTERS
    /**
     * Getter for $label.
     * @return string
     */
    public function label() {
        return $this->label;
    }
    /**
     * Getter for $name.
     * @return string
     */
    public function name() {
        return $this->name;
    }
    /**
     * Getter for $value.
     * @return string
     */
    public function value() {
        return $this->value;
    }

    /**
     * Getter for $validators.
     * @return mixed
     */
    public function validators() {
        return $this->validators;
    }

    // SETTERS
    /**
     * Setter for $label.
     * @param string $label
     * @return void
     */
    public function setLabel($label) {
        $this->label = $label;
    }
    /**
     * Setter for $label.
     * @param string $name
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
    }
    /**
     * Setter for $label.
     * @param string $value
     * @return void
     */
    public function setValue($value) {
        $this->value = $value;
    }

    /**
     * Setter for $validators.
     * @param array $validators
     * @return void
     */
    public function setValidators(array $validators) {
        foreach ($validators as $validator) {
            if ($validator instanceof Validator && !in_array($validator, $this->validators)) {
                $this->validators[] = $validator;
            }
        }
    }
}