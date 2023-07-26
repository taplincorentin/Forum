<?php
namespace Model\Entities;

use App\Entity;

final class Topic extends Entity
{

        private string $id;
        private string $title;
        private User $user;
        private $creationdate;
        private int $locked;
        private Category $category;
        private int $nbPosts;

        public function __construct($data)
        {
                $this->hydrate($data);
        }

        public function getId() {
                return $this->id;
        }

        public function getTitle() {
                return $this->title;
        }
        
        public function getUser(){
                return $this->user;
        }

        public function getCreationdate(){
                $formattedDate = $this->creationdate->format("d/m/Y, H:i:s");
                return $formattedDate;
        }
        
        public function getLocked(){
                return $this->locked;
        }

        public function getCategory(){
                return $this->category;
        }

        public function getNbPosts(){
                return $this->nbPosts;
        }

        public function setId($id) {
                $this->id = $id;
                return $this;
        }

        public function setTitle($title){
                $this->title = $title;
                return $this;
        }

        public function setUser($user){
                $this->user = $user;
                return $this;
        }

        public function setCreationdate($date){
                $this->creationdate = new \DateTime($date);
                return $this;
        }

        public function setLocked($locked){
                $this->locked = $locked;
                return $this;
        }

        public function setCategory($category){
                $this->category = $category;
                return $this;
        }
        public function setNbPosts($nbPosts){
                $this->nbPosts = $nbPosts;
                return $this;
        }



}