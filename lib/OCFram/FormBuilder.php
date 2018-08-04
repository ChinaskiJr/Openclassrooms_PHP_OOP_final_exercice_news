<?php

namespace OCFram;

/**
 * Class that daughters will generate Form
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1669084-gerer-les-formulaires
 * @version 1.0
 */
abstract class FormBuilder {
    /**
     * @var Form $form
     */
    protected $form;

    /**
     * FormBuilder constructor.
     * @param Entity $entity
     * @return void
     */
    public function __construct(Entity $entity) {
        $this->setForm(new Form($entity));
    }

    /**
     * Build the form.
     * @return void
     */
    abstract public function build();

    /**
     * Getter for $form.
     * @return Form
     */
    public function form() {
        return $this->form;
    }

    /**
     * Setter of $form;
     * @param Form $form
     */
    public function setForm(Form $form) {
        $this->form = $form;
    }

}