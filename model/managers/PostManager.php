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

        // a.id_post, a.content, a.creation_date, t.id_topic, t.title, t.creation_date, u.id_user, u.username, u.email, u.creation_date 
        $sql = "SELECT *
                    FROM " . $this->tableName . " a WHERE a.topic_id =" . $id . " " . $orderQuery;


        return $this->getMultipleResults(
            DAO::select($sql),
            $this->className
        );
    }

}