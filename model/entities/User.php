<?php
namespace Model\Entities;

use App\Entity;

final class User extends Entity
{
    private $id;
    private $username;
    private $password;
    private $role;
    private $email;
    private $creationdate;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    //getters
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCreationdate()
    {
        $formattedDate = $this->creationdate->format("d/m/Y, H:i:s");
        return $formattedDate;
    }



    //setters
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setCreationdate($date)
    {
        $this->creationdate = new \DateTime($date);
        return $this;
    }
}