<?php

// invoice status = 1 - emisa, neplatita
// invoice status = 2 - platita, incheiata
// invoice status = 0 - neplatita, anulata

class InvoicesModel extends DBModel
{
    protected $clientID;
    protected $items;
    protected $value;
    protected $series;
    protected $currency;
    protected $status;
    protected $VAT;
    protected $totalValue;
    protected $emitDate;
    protected $payDate;

    public function __construct($clientID = '', $series = '', $items = '', $value = '', $VAT = '', $totalValue = '', $currency = '', $status = '', $emitDate = '', $payDate = '')
    {
        $this->clientID = $clientID;
        $this->items = $items;
        $this->value = $value;
        $this->series = $series;
        $this->currency = $currency;
        $this->status = $status;
        $this->VAT = $VAT;
        $this->totalValue = $totalValue;
        $this->emitDate = $emitDate;
        $this->payDate = $payDate;
    }



    public function addInvoice($clientID, $series, $value, $VAT, $currency, $status, $emitDate){
        $q = "INSERT INTO `invoices`(`clientID`, `series`, `value`, `VAT`, `currency`, `status`, `emitDate`) VALUES (?,?,?,?,?,?,?);"; 
        $myPrep = $this->db()->prepare($q);
        $myPrep->bind_param("isiisss", $clientID, $series, $value, $VAT, $currency, $status, $emitDate);
        return $myPrep->execute();  
    }
   

    public function displayInvoices()
    {
        $q = "SELECT * FROM `invoices`";
        $result = $this->db()->query($q);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getInvoiceDetails($id){
        $q = "SELECT * FROM `invoices` WHERE `id` = $id";
        $result = $this->db()->query($q);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function lastInvoiceID(){
        $q = "SELECT `id` FROM `invoices` ORDER BY `id` DESC LIMIT 1";
        $result = $this->db()->query($q);
        return $result->fetch_all();
    }
}
