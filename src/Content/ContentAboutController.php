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


class ContentAboutController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    // filter text funktion (använder ramverkets)
    // rendera startsidan inuti content

    public function indexAction() : object
    {
        $page = $this->di->get("page");
        $page->add("content/about", [
            "items" => "test"
        ]);
        return $page->render([
            "title" => "A collection of items",
        ]);
    }
}