<?php

class ClientsModel extends DBModel
{
    protected $name;
    protected $cui;
    protected $j;

    public function __construct($name='', $cui='', $j=''){
        $this->name = $name;
        $this->cui = $cui;
        $this->j = $j;
    }


    public function addClient($name, $cui, $j){
        //$q = "INSERT INTO..."
    }

}