<?php
namespace Model;
use \Entity\Comment;

/**
 * Manage the comments with PDOStatement
 * @author ChinaskiJr
 * @license CC -> Realized for the Openclassrooms class on OOP in PHP :
 * https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1668568-developpement-de-la-bibliotheque
 * @version 1.0
 */
class CommentsManagerPDO extends CommentsManager {
    /**
     * @see CommentsManager
     */
    protected function add(Comment $comment) {
        $sql = 'INSERT INTO comments SET news = :news, author = :author, content = :content, date = NOW()';
        $q = $this->dao->prepare($sql);
        $q->bindValue(':news', $comment->news(), \PDO::PARAM_INT);
        $q->bindValue(':author', $comment->author(), \PDO::PARAM_STR);
        $q->bindValue(':content', $comment->content(), \PDO::PARAM_STR);
        $q->execute();
        $comment->setId($this->dao->lastInsertId());
    }

    /**
     * @see CommentsManager
     */
    protected function modify(Comment $comment) {
        $sql = 'UPDATE comments SET author = :author, content = :content WHERE id = :id';
        $q = $this->dao->prepare($sql);
        $q->bindValue(':author', $comment->author(), \PDO::PARAM_STR);
        $q->bindValue(':content', $comment->content(), \PDO::PARAM_STR);
        $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
        $q->execute();
    }

    /**
     * @see CommentsManager
     */
    public function get($id) {
        $sql = 'SELECT id, news, author, content FROM comments WHERE id = :id';
        $q = $this->dao->prepare($sql);
        $q->bindValue(':id', $id, \PDO::PARAM_INT);
        $q->execute();

        $data = $q->fetch(\PDO::FETCH_ASSOC);
        $comment = new Comment([
            'id' => $id,
            'news' => (int) $data['news'],
            'author' => $data['author'],
            'content' => $data['content']
        ]);
        return $comment;
    }

    /**
     * @see CommentsManager
     */
    public function getListOf($news) {
        $sql = 'SELECT id, news, author, content, date FROM comments WHERE news = :news';
        $q = $this->dao->prepare($sql);
        $q->bindValue(':news', $news, \PDO::PARAM_INT);
        $q->execute();
        $listComment = [];
        while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
            $data['id'] = (int) $data['id'];
            $data['news'] = (int) $data['news'];
            $data['date'] = new \DateTime($data['date']);
            array_push($listComment, new Comment($data));
        }
        return $listComment;
    }
}