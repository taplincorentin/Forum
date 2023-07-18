<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager
{

    protected $className = "Model\Entities\Post";
    protected $tableName = "post";


    public function __construct()
    {
        parent::connect();
    }

    public function findPosts($id, $order)
    {
        $orderQuery = ($order) ?
            "ORDER BY " . $order[0] . " " . $order[1] :
            "";

        $sql = "SELECT *
                    FROM " . $this->tableName . " a
                    INNER JOIN topic t
                    ON a.topic_id = t.id_topic
                    WHERE t.id_topic =" . $id . " " . $orderQuery;

        return $this->getMultipleResults(
            DAO::select($sql),
            $this->className
        );
    }
}