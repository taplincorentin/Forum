<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager
{
    protected $className = "Model\Entities\User";
    protected $tableName = "user";


    public function __construct(){
        parent::connect();
    }

    public function usernameExists($username){
        $sql = "SELECT *
                    FROM user 
                    WHERE username  = :username";

        return DAO::select($sql, ['username' => $username]);
    }

    public function emailExists($email){
        $sql = "SELECT *
                    FROM user 
                    WHERE email  = :email";

        return DAO::select($sql, ['email' => $email]);
    }
    
    public function updatePassword($id,$password){
        $sql = "UPDATE user
                    SET password = :password
                    WHERE id_user = :id";

        return DAO::update($sql, ['id' => $id,
                                'password' => $password]);
    }
}