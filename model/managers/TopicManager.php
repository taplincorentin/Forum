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


        $sql = "SELECT * FROM " . $this->tableName . " a WHERE a.category_id =" . $id . " " . $orderQuery;

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
}