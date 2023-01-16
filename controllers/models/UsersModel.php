<?php

class UsersModel extends DBModel
{
    protected $userName;
    protected $name;
    protected $password;
    protected $level;

    public function __construct($userName='', $name='', $password='', $level=''){
        $this->name = $userName;
        $this->name = $name;
        $this->password = $password;
    }



    public function isAuth($userName, $password){
        $q = "SELECT * FROM `users` WHERE `username`= ? ";
        $myPrep = $this->db()->prepare($q);
        $myPrep->bind_param("s", $userName);
        $myPrep->execute();
        $result = $myPrep->get_result()->fetch_assoc();

        if($result){
            if(password_verify($password, $result['password'])){
                return true;
            }
            else return false;
        }
        else {
            return false;
        }
    }

    public function addUser($userName, $name, $password, $level){
        $q = "INSERT INTO `users` (`name`, `userName`, `password`, `level`) VALUES (?, ?, ?, ?);";
        $myPrep = $this->db()->prepare($q);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $myPrep->bind_param("sssi", $userName, $name, $hash, $level);
        return $myPrep->execute();
    }

    public function showUsers(){
        $q = "SELECT `name`, `username` FROM users";
        $result = $this->db()->query($q);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
   
    public function delUser($id){
        $q = "DELETE FROM `users_test` WHERE `id` = $id";
		$result = $this->db()->query($q);
        if($result) return true;
        else return false;
    }
}