<?php

namespace Anax\Answer\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Moody\Answer\Answer;

class UpdateForm extends FormModel
{
    public function __construct(ContainerInterface $di, $id)
    {
        parent::__construct($di);
        $answer = $this->getItemDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Update details of the item",
            ],
            [
                "id" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $answer->id,
                ],
                "answer" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                    "value" => $answer->answer,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Save",
                    "callback" => [$this, "callbackSubmit"]
                ],
                "reset" => [
                    "type"      => "reset",
                ],
            ]
        );
    }

    public function getItemDetails($id) : object
    {
        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));
        $answer->find("id", $id);
        return $answer;
    }


    public function callbackSubmit() : bool
    {
        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));
        $answer->find("id", $this->form->value("id"));
        $answer->answer = $this->form->value("answer");
        $answer->save();
        return true;
    }
}