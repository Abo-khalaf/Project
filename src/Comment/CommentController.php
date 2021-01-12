<?php
namespace Moody\Comment;
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Comment\HTMLFORM\CreateForm;


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;
/**
 * A sample controller to show how a controller class can be implemented.
 */
class CommentController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    /**
     * @var $data description
     */

    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));
        $page->add("comment/crud/view-all", [
            "items" => $comment->findAll(),
        ]);
        return $page->render([
            "title" => "A collection of items",
        ]);
    }
    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function createAction(int $questionID, $type) : object
    {
        $page = $this->di->get("page");
        $form = new CreateForm($this->di, $questionID, $type);
        $form->check();
        $page->add("comment/crud/create", [
            "form" => $form->getHTML(),
        ]);
        return $page->render([
            "title" => "Create a item",
        ]);
    }
    /**
     * Handler with form to delete an item.
     *
     * @return object as a response object
     */
    public function deleteAction() : object
    {
        $page = $this->di->get("page");
        $form = new DeleteForm($this->di);
        $form->check();
        $page->add("comment/crud/delete", [
            "form" => $form->getHTML(),
        ]);
        return $page->render([
            "title" => "Delete an item",
        ]);
    }
    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function updateAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new UpdateForm($this->di, $id);
        $form->check();
        $page->add("comment/crud/update", [
            "form" => $form->getHTML(),
        ]);
        return $page->render([
            "title" => "Update an item",
        ]);
    }
}