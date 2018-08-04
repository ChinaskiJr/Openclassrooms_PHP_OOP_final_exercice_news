<?php

namespace FormBuilder;

use OCFram\FormBuilder;
use OCFram\StringField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
use OCFram\TextField;

/**
 * Class that generates Form for Comment.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1669084-gerer-les-formulaires
 * @version 1.0
 */
class CommentFormBuilder extends FormBuilder {
    public function build() {
        $this->form->add(new StringField([
            'label' => 'Pseudo',
            'name' => 'author',
            'maxLength' => 50,
            'validators' => [
                new MaxLengthValidator('The name of the author is too long (50 characters max)', 50),
                new NotNullValidator('You have to fill the pseudo field'),
            ],
            ]))
            ->add(new TextField([
                'label' => 'Content',
                'name' => 'content',
                'rows' => 7,
                'cols' => 50,
                'validators' => [
                    new NotNullValidator('You have to fill the content field'),
                ],
            ]));
    }
}