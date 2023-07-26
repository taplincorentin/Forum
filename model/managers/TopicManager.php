<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager
{

    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";


    public function __construct()
    {
        parent::connect();
    }

    public function findTopics($id, $order)
    {
        $orderQuery = ($order) ?
            "ORDER BY " . $order[0] . " " . $order[1] :
            "";

        $sql = "SELECT id_topic, title, t.creationDate, t.user_id, t.locked, t.category_id, COUNT(p.topic_id) AS nbPosts
            FROM topic t
            LEFT JOIN post p ON p.topic_id = t.id_topic
            WHERE t.category_id = " . $id ." GROUP BY t.id_topic " .$orderQuery;
        

        return $this->getMultipleResults(
            DAO::select($sql),
            $this->className
        );
    }

    public function lockTopic($id){
        $sql = "UPDATE topic
                    SET locked = 1
                    WHERE id_topic = :id";

        return DAO::update($sql, ['id' => $id]);
    }

    public function unlockTopic($id){
        $sql = "UPDATE topic
                    SET locked = 0
                    WHERE id_topic = :id";

        return DAO::update($sql, ['id' => $id]);
    }

    public function getNbPosts($id){
        $sql = "SELECT COUNT(id_post) AS nbPosts FROM post WHERE topic_id = :id";

        return DAO::update($sql, ['id' => $id]);
    }
}