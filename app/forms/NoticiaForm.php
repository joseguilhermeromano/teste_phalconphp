<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation;

class NoticiaForm extends Form 
{
    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = [])
    {
        if (!isset($options["edit"])) {
            $element = new Text("id");

            $element->setLabel("Id");

            $this->add(
                $element
            );
        } else {
            $this->add(
                new Hidden("id")
            );
        }



        $titulo = new Text("titulo");

        $titulo->setLabel("Titulo");

        $titulo->setFilters(
            [
                "striptags",
                "string",
            ]
        );

        $titulo->addValidators(
            [
                new \Phalcon\Validation\Validator\PresenceOf(
                    [
                        "message" => "O Título é obrigatório",
                    ]
                ),
                new \Phalcon\Validation\Validator\StringLength(
                    [
                        "max" => 255,
                        "messageMaximum" => "O Título não pode exceder 255 caracteres.",
                        "included" => true
                    ]
                ) 
            ]
        );

        $this->add($titulo);
    }
}
