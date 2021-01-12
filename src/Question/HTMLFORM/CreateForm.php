<?php
namespace Anax\Question\HTMLForm;
use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Moody\Question\Question;
use Moody\Tags\Tags;
use Moody\User\User;

class CreateForm extends FormModel
{
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Details of the item",
            ],
            [
                "title" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],
                "question" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                ],
                "tags" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Create item",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }


    public function callbackSubmit() : bool
    {
        $questions = new Question();
        $user = new User();
        $user->setDb($this->di->get("dbqb"));

        $questions->setDb($this->di->get("dbqb"));
        $questions->title  = $this->form->value("title");
        $questions->userID  = $this->di->session->get("userID");


        $questions->question = $this->form->value("question");
        $questions->created = date('Y-m-d H:i');
        $tagArray = explode(" ", $this->form->value("tags"));
        $tagArray = array_filter($tagArray);
        $questions->tags = implode(" ", $tagArray);

        foreach ($tagArray as $tagArray) {
            $tags = new Tags();
            $tags->setDb($this->di->get("dbqb"));
            $tags->find("tag", $tagArray);
            if (!$tags->tag == $tagArray) {
                $tags->tag = $tagArray;
                $tags->counter = 1;
                $tags->save();
            } else {
                $tags->tag = $tagArray;
                $tags->counter = $tags->counter + 1;
                $tags->save();
            }
        }
        $user->findById($questions->userID);

        $questions->save();
        $user->save();
        return true;
    }

    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("questions")->send();
    }
}