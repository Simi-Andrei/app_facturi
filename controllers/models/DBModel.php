<?php

class DBModel
{
    protected $conn;

    public function db(){
        $this->conn = new mysqli('localhost', 'user', '123test', 'aplicatie_facturare');
        if($this->conn->connect_error){
            die('Connection error!');
        }
        return $this->conn;
    } 
}