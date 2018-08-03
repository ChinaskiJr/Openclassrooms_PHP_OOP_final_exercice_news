<?php
namespace Model;
use \Entity\News;

class NewsManagerPDO extends NewsManager {
    /**
     * @see NewsManager
     */
    public function getList($beginning = -1, $limit = -1) {
        $sql = 'SELECT id, author, title, content, dateAdd, dateEdit FROM news ORDER BY id DESC';

        if ($beginning != -1 || $limit != -1) {
            $sql .= ' LIMIT ' . (int) $limit . ' OFFSET ' . (int) $beginning;
        }
        $q = $this->dao->query($sql);
        $listNews = [];
        while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
            $data['id'] = (int) $data['id'];
            $data['dateAdd'] = new \DateTime($data['dateAdd']);
            $data['dateEdit'] = new \DateTime($data['dateEdit']);
            array_push($listNews, new \Entity\News($data));
        }
        $q->closeCursor();

        return $listNews;
    }
    /**
     * @see NewsManager
     */
    public function getUnique($id) {
        $sql = 'SELECT id, author, title, content, dateAdd, dateEdit FROM news WHERE id = :id';
        $q = $this->dao->prepare($sql);
        $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $q->execute();
        $data = $q->fetch(\PDO::FETCH_ASSOC);
        $data['id'] = (int) $data['id'];
        $data['dateAdd'] = new \DateTime($data['dateAdd']);
        $data['dateEdit'] = new \DateTime($data['dateEdit']);
        $news = new \Entity\News($data);
        $q->closeCursor();

        return $news;
    }
    /**
     * @see NewsManager
     */
    public function count() {
        $sql = 'SELECT COUNT(*) FROM news';
        return $this->dao->query($sql)->fetchColumn();
    }
    /**
     * @see NewsManager
     */
    protected function add(News $news) {
        $sql = 'INSERT INTO news SET author = :author, title = :title, content = :content, dateAdd = NOW(), dateEdit = NOW()';
        $q = $this->dao->prepare($sql);
        $q->bindValue(':title', $news->title(), \PDO::PARAM_STR);
        $q->bindValue(':author', $news->author(), \PDO::PARAM_STR);
        $q->bindValue(':content', $news->content(), \PDO::PARAM_STR);
        $q->execute();
    }
    /**
     * @see NewsManager
     */
    protected function modify(News $news) {
        $sql = 'UPDATE news SET author = :author, title= :title, content = :content, dateEdit = NOW() WHERE id = :id';
        $q = $this->dao->prepare($sql);
        $q->bindValue(':title', $news->title(), \PDO::PARAM_STR);
        $q->bindValue(':author', $news->author(), \PDO::PARAM_STR);
        $q->bindValue(':content', $news->content(), \PDO::PARAM_STR);
        $q->bindValue(':id', $news->id(), \PDO::PARAM_INT);
        $q->execute();
    }
}