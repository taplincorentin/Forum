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


        $sql = "SELECT id_topic, title, creation_date, locked, category_id, user_id
                    FROM " . $this->tableName . " a
                    INNER JOIN category c
                    ON a.category_id = c.id_category
                    WHERE c.id_category =" . $id." ".$orderQuery;

        return $this->getMultipleResults(
            DAO::select($sql),
            $this->className
        );
    }
}