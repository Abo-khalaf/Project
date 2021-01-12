<?php
namespace Moody\Content;
/**
 *kontroller klass för content
 */
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Moody\Answer\Answer;
use Moody\User\User;
use Moody\Question\Question;
use Moody\Tags\Tags;
use Moody\Latest\Latest;
use Moody\Comment\Comment;


class ContentController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    // filter text funktion (använder ramverkets)
    // rendera startsidan inuti content
    public function indexAction() : object
    {
        $page = $this->di->get("page");
        $questions = new Question();
        $question3 = new Question();
        $answers = new Answer();
        $tags = new Tags;
        $users = new User;

        $comment = new Comment;

        $answers->setDb($this->di->get("dbqb"));
        $questions->setDb($this->di->get("dbqb"));
        $question3->setDb($this->di->get("dbqb"));

        $tags->setDb($this->di->get("dbqb"));
        $users->setDb($this->di->get("dbqb"));
        $comment->setDb($this->di->get("dbqb"));

        $postDb = new Latest();
        $page->add("content/index", [
            "questions" => $postDb->getLatestPosts($this->di, 2),
            "tags" => $postDb->getLatestTags($this->di, 2),
            "users" => $postDb->getLatestUsers($this->di, 2),
            "answers" => $answers,
            "comment" => $comment,
            "question3" => $question3,



        ]);
        return $page->render([
            "title" => "A collection of items",
        ]);
    }

}