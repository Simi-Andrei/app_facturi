<?php

class AddInvoiceController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {

        $invoice = new InvoicesModel();
        $item = new ItemsModel();

        $series = $_POST['series'];
        $nrFactura = $_POST['number'];
        $emitDate = date('Y-m-d', strtotime($_POST['emitDate']));
        $currency = $_POST['currency'];

        $clientID = 1; // pana cand avem drop down
        $lastInvoiceID = '';
        $value = NULL;
        $VAT = 19;
        $status = 1;

        $data['test'] = '';


        $nrProduse = count($_POST['product_name']);

        for($i=0; $i<$nrProduse; $i++){
            $prodPrice = $_POST['product_price'][$i];
            $prodQty = $_POST['product_qty'][$i];

            $value += $prodPrice * $prodQty;
        }

        


        if($invoice->addInvoice($clientID, $series, $value, $VAT, $currency, $status, $emitDate)){
            $lastInvoiceID = $invoice->lastInvoiceID()[0][0];
        } else $data['test'] = ' n-a mers';


     
            //ADD ITEMS LOGIC
        // 

            for($i=0; $i<$nrProduse; $i++){
            $prodName = $_POST['product_name'][$i];
            $prodPrice = $_POST['product_price'][$i];
            $prodQty = $_POST['product_qty'][$i];

            if($item->addItem($prodName, $lastInvoiceID, $prodPrice, $prodQty))
            header('Location: ?page=invoices'); 
            else {$data['test'] .= "n-a mers";}
        }



        //get info from invoice form 
        //get value and quantity of items - calculate the total price for invoice
        //calculate total with and without VAT
        //create the invoice and get id 
        //add the items in BD with the invoiceID 

            
        

        
    
       



        $content["content"] = $this->render(APP_PATH . VIEWS . 'test.html', $data);
        echo $this->render(APP_PATH . VIEWS . 'boilerplate.html', $content);
        

     


    }
}


