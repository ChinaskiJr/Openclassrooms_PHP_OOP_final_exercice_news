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
        $q = $this->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

        $listNews = $q->fetchAll();

        foreach ($listNews as $news) {
            $news->setDateAdd(new \DateTime($news->dateTime()));
            $news->setDateEdit(new \DateTime($news->dateEdit()));
        }
        $q->closeCursor();

        return $listNews;
    }
}