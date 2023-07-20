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


        $sql = "SELECT * FROM " . $this->tableName . " a WHERE a.topic_id =" . $id . " " . $orderQuery;


        return $this->getMultipleResults(
            DAO::select($sql),
            $this->className
        );
    }

    public function findTopicIdFromPost($id){
        $sql = "SELECT id_topic FROM topic t INNER JOIN post p ON t.id_topic = p.topic_id WHERE p.id_post =".$id;

        return $this->getMultipleResults(
            DAO::select($sql),
            $this->className
        );
    }

}