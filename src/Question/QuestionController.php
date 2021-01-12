<?php
namespace Moody\Question;
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Question\HTMLFORM\CreateForm;
use Moody\Answer\Answer;
use Moody\User\User;
use Moody\Comment\Comment;

class QuestionController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $questions = new Question();
        $answers = new Answer();
        $answers->setDb($this->di->get("dbqb"));
        $questions->setDb($this->di->get("dbqb"));
        $page->add("questions/crud/view-all", [
            "questions" => $questions->findAll(),
            "answers" => $answers
        ]);
        return $page->render([
            "title" => "A collection of items",
        ]);
    }

    public function createAction() : object
    {
        $page = $this->di->get("page");
        $form = new CreateForm($this->di);
        $form->check();
        $page->add("questions/crud/create", [
            "form" => $form->getHTML(),
        ]);
        return $page->render([
            "title" => "Create a item",
        ]);
    }

    public function deleteAction() : object
    {
        $page = $this->di->get("page");
        $form = new DeleteForm($this->di);
        $form->check();
        $page->add("questions/crud/delete", [
            "form" => $form->getHTML(),
        ]);
        return $page->render([
            "title" => "Delete an item",
        ]);
    }

    public function updateAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new UpdateForm($this->di, $id);
        $form->check();
        $page->add("questions/crud/update", [
            "form" => $form->getHTML(),
        ]);
        return $page->render([
            "title" => "Update an item",
        ]);
    }

    public function viewAction(int $id) : object
    {
        $page = $this->di->get("page");
        $question = new Question();
        $answers = new Answer();
        $user = new User();
        $comment = new Comment();
        $question->setDb($this->di->get("dbqb"));
        $user->setDb($this->di->get("dbqb"));
        $answers->setDb($this->di->get("dbqb"));
        $comment->setDb($this->di->get("dbqb"));

        $question->find("id", $id);
        $user->find("id", $question->userID);
        $answers = $answers->findAllWhere("question_id = ?", $question->id);
        $page->add("questions/crud/view", [
            "question" => $question,
            "answers" => $answers,
            "user" => $user,
            "questionComment" => $comment->findAllWhere("questionID = ?", $question->id),
            "comment" => $comment,
        ]);
        return $page->render([
            "title" => "A collection of items",
        ]);
    }


}