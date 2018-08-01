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
            array_push($listComment, new \Entity\Comment($data));
        }
        return $listComment;
    }
}