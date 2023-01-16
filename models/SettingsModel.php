<?php

class SettingsModel extends DBModel
{
        protected $name;
        protected $cui;
        protected $j;
        protected $location ;
        protected $iban;
        protected $bank;
    

    public function __construct($name='', $cui='', $j='', $location='', $iban=''){
        $this->name = $name;
        $this->cui = $cui;
        $this->j = $j;
        $this->location = $location;
        $this->iban = $iban;
    }


    public function addSetting($name, $cui, $j, $location, $iban, $bank){
        $q = "INSERT INTO `settings`(`name`, `cui`, `j`, `location`, `iban`, `bank`) VALUES (?, ?, ?, ?, ?, ?);";
        $myPrep = $this->db()->prepare($q);
        $myPrep->bind_param("ssssss", $name, $cui, $j, $location, $iban, $bank);
        return $myPrep->execute();
    }

    public function getSettings(){
        $q = "SELECT * FROM `settings` ORDER BY `id` DESC LIMIT 1";
        $result = $this->db()->query($q);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}