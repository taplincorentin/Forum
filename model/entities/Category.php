<?php
    namespace Model\Entities;

    use App\Entity;

    final class Category extends Entity{
        private $id;
        private $name;

        public function __construct($data){         
            $this->hydrate($data);        
        }

        //getters
        public function getId(){
                return $this->id;
        }

        public function getName(){
                return $this->name;
        }
 

        //setters
        public function setId($id){
                $this->id = $id;
                return $this;
        }

        public function setName($name){
                $this->name = $name;
                return $this;
        }
    }