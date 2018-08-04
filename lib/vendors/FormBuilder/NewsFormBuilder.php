<?php

namespace FormBuilder;

use OCFram\FormBuilder;
use OCFram\MaxLengthValidator;
use OCFram\NotNullValidator;
use OCFram\StringField;
use OCFram\TextField;

/**
 * Class that generates Form for News.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1669084-gerer-les-formulaires
 * @version 1.0
 */
class NewsFormBuilder extends FormBuilder {
    public function build() {
        $this->form->add(new StringField([
            'label' => 'Author',
            'name' => 'author',
            'maxLength' => 50,
            'validators' => [
                new MaxLengthValidator('The author\'s name must not be longer than 50 characters)', 50),
                new NotNullValidator('Please fill the author field.'),
            ],
            ]))
            ->add(new StringField([
                'label' => 'Title',
                'name' => 'title',
                'maxLength' => 50,
                'validators' => [
                    new MaxLengthValidator('The title\'s name must not be longer than 50 characters)', 50),
                    new NotNullValidator('Please fill the title field.'),
                ],
            ]))
            ->add(new TextField([
                'label' => 'Content',
                'name' => 'content',
                'rows' => 9,
                'cols' => 60,
                'validators' => [
                    new NotNullValidator('Please fill the content field.'),
                ],
            ]));
    }
}