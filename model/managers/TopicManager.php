<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }

        public function findTopics($id){

            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    INNER JOIN category c
                    ON a.category_id = c.id_category
                    WHERE c.id_category =".$id;

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
    }