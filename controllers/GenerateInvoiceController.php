<?php

use Dompdf\Dompdf;


class GenerateInvoiceController extends AppController {
    public function __construct(){
        $this->init();
    }

    public function init(){



        $invoice = new InvoicesModel;
        $client = new ClientsModel;
        $item = new ItemsModel;
        $settings = new SettingsModel;


        $invoiceID = $_GET['id'];

        $detaliiFactura = $invoice->getInvoiceDetails($invoiceID);
        $clientID = $detaliiFactura[0]["clientID"];
        $value = $detaliiFactura[0]["value"];

        
        $serieFactura = $detaliiFactura[0]["series"];

//invoice info
        $data['nrSerieFactura'] = $serieFactura . "-" . $invoiceID;
        $data['status'] = '';
        $data['emitDate'] = $detaliiFactura[0]["emitDate"];
        
        $data['item'] = '';
        $data['itemCost'] = '';
        $data['currency'] = strtoupper($detaliiFactura[0]["currency"]);
        $data['totalValue'] = $value;
        $data['quantity'] = '';



//client info
        $detaliiClient = $client->getClientDetails($clientID);
        $data['clientName'] = $detaliiClient[0]["name"];
        $data['clientLocation'] = $detaliiClient[0]["location"];



//produse info
        $data['productsTable'] = '';
        $itemsDetails = $item->getItemDetailsByInvoice($invoiceID);
        foreach($itemsDetails as $item){
        $data['productsTable'] .= '<tr>
        <td style="width: 33.333333%; padding: 10px">' . $item['description'] . '</td>
        <td style="width: 33.333333%; padding: 10px">' . $item['quantity'] . '</td>
        <td style="width: 33.333333%; padding: 10px">' . $item['unitPrice'] . '</td>
      </tr>';}


//settings info
            $settingsInfo = $settings->getSettings();
            $data['settingsName'] = $settingsInfo[0]['name'];
            $data['settingsLocation'] = $settingsInfo[0]['location'];

         
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->render(APP_PATH.VIEWS.'invoiceTemplate.html',$data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($data['nrSerieFactura']);


      
        // $content['test'] = var_dump($settingsInfo);

        //  echo $this->render(APP_PATH . VIEWS . 'test.html', $content);


    }
}