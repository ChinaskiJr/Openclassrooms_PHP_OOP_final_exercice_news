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
}