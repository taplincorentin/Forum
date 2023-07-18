<?php
namespace Model\Entities;

use App\Entity;

final class Post extends Entity
{
    private $id;
    private $content;
    private User $user;
    private $creationdate;
    private Topic $topic;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    //getters
    public function getId()
    {
        return $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getUser()
    {
        return $this->user;
    }


    public function getCreationdate()
    {
        $formattedDate = $this->creationdate->format("d/m/Y, H:i:s");
        return $formattedDate;
    }

    public function getTopic()
    {
        return $this->topic;
    }



    //setters
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function setCreationdate($date)
    {
        $this->creationdate = new \DateTime($date);
        return $this;
    }

    public function setTopic($topic)
    {
        $this->topic = $topic;
        return $this;
    }
}