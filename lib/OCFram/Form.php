<?php

namespace OCFram;

/**
 * Represent a form to send to the view.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1669084-gerer-les-formulaires
 * @version 1.0
 */

class Form extends Entity {
    /**
     * @var $entity Entity
     */
    protected $entity;
    /**
     * @var $fields array
     */
    protected $fields = [];

    /**
     * Form constructor.
     * @param Entity $entity
     * @return void
     */
    public function __construct(Entity $entity) {
        $this->entity = $entity;
    }

    /**
     * Add a Field instance in the fields array.
     * @param Field $field
     * @return Form
     */
    public function add(Field $field) {
        // Get the name of the field
        $attr = $field->name();
        // Assignate the value to the field
        $field->setValue($this->entity->$attr());
        // Stock the field into the field lists of the object
        $this->fields[] = $field;
        // Return the object
        return $this;
    }

    /**
     * Create the HTML in functions of the fields array.
     * @return string
     */
    public function createView() {
        $view = '';
        foreach ($this->fields as $field) {
            $view .= $field->buildWidget() . '<br />';
        }
        return $view;
    }

    /**
     * Check if every fields are valid.
     * @return bool
     */
    public function isValid() {
        $valid = true;
        foreach ($this->fields as $field) {
            if (!$field->isValid()) {
                $valid = false;
            }
        }
        return $valid;
    }

    /**
     * Getter for $entity.
     * @return Entity
     */
    public function entity() {
        return $this->entity;
    }

    /**
     * Setter for $entity.
     * @param Entity $entity
     */
    public function setEntity(Entity $entity) {
        $this->entity = $entity;
    }
}