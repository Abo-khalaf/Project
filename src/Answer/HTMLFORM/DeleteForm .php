<?php

namespace Anax\Answer\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Moody\Answer\Answer;

class DeleteForm extends FormModel
{
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Delete an item",
            ],
            [
                "select" => [
                    "type"        => "select",
                    "label"       => "Select item to delete:",
                    "options"     => $this->getAllItems(),
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Delete item",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }

    protected function getAllItems() : array
    {
        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));
        $answers = ["-1" => "Select an item..."];
        foreach ($answer->findAll() as $obj) {
            $answers[$obj->id] = "{$obj->column1} ({$obj->id})";
        }
        return $answers;
    }

    public function callbackSubmit() : bool
    {
        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));
        $answer->find("id", $this->form->value("select"));
        $answer->delete();
        return true;
    }

    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("answer")->send();
    }
}