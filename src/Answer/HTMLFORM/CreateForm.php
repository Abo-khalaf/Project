<?php

namespace Anax\Answer\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Moody\Question\Question as Question;
use Moody\Answer\Answer;

class CreateForm extends FormModel
{
    private $question = "";
    public function __construct(ContainerInterface $di, $id)
    {
        parent::__construct($di);
        $this->question = $this->getItemDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Skapa svar",
            ],
            [
                "answer" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                ],
                "question" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "value" => $this->question->id,
                ],
                "user" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "value" => $di->session->get("userID"),
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Publicera svar",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }

    public function callbackSubmit() : bool
    {
        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));
        $answer->answer  = $this->form->value("answer");
        $answer->userID = $this->form->value("user");
        $answer->question_id = $this->form->value("question");
        $answer->username = $this->di->session->get("username");
        $answer->created = date('Y-m-d H:i');

        $answer->save();
        return true;
    }

    public function getItemDetails($id) : object
    {
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $question->find("id", $id);
        return $question;
    }

    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("questions/view/". $this->question->id)->send();
    }
}