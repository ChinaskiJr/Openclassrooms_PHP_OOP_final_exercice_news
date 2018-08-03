<?php
namespace Model;
use \OCFram\Manager;
use \Entity\Comment;
/**
 * Abstract class for managing comments.
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
abstract class CommentsManager extends Manager {
    /**
     * Add a comment to the database.
     * @param Comment $comment
     * @return void
     */
    abstract protected function add(Comment $comment);

    /**
     * Check if the comment is new in order to let the Manager knows if he has to invoke add() or modify().
     * @param Comment $comment
     * @return void
     */
    public function save(Comment $comment) {
        if ($comment->isValid()) {
            $comment->isNew() ? $this->add($comment) : $this->modify($comment);
        } else {
            throw new \RuntimeException('The comment must be validated before being send');
        }
    }

    /**
     * Edit a comment in the database.
     * @param Comment $comment
     * @return void
     */
    abstract protected function modify(Comment $comment);

    /**
     * Get a specifif comment from the database.
     * @param Comment $comment
     * @return Comment
     */
    abstract public function get($id);

    /**
     * Get a list of comments from the database.
     * @param $news
     * @return array
     */
    abstract public function getListOf($news);

    /**
     * Delete a comment from the database.
     * @param $id
     * @return void
     */
    abstract public function delete($id);
}