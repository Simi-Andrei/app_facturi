<?php

class ShowInvoicesController extends AppController 
{
    public function __construct(){
        $this->init();
    }

    public function init(){

        $invoice = new InvoicesModel();
        $result = $invoice->displayInvoices();
        $client = new ClientsModel();

        

        $data['invoicesTableContent'] = "";


        foreach($result as $invoice){

          $clientDetails = $client->getClientDetails($invoice["clientID"]);


            $data["invoicesTableContent"] .= "<tr class='bg-white even:bg-sky-50 border-b mx-20 text-neutral-900 hover:bg-sky-200'>
            <td class='px-6 py-2 whitespace-nowrap text-center'>
              <a href='?page=genInv&id=" . $invoice["id"] . "' type='button' class='bg-sky-100 px-3 rounded-md group'>
                <i
                  class='fa-sharp fa-solid fa-download text-sky-900 text-lg group-hover:text-orange-600 transition-all duration-150'
                ></i>
              </a>
            </td>
            <td class='px-6 py-2 whitespace-nowrap text-center'>" .$invoice["emitDate"]. "</td>
            <td class='px-6 py-2 whitespace-nowrap text-center'>" . $invoice["series"] . "-" . $invoice["id"] . "</td>
            <td class='px-6 py-2 whitespace-nowrap text-center hidden lg:table-cell'>
              ". $clientDetails[0]["name"] ."
            </td>
            <td class='px-6 py-2 whitespace-nowrap text-center hidden lg:table-cell'>
             " . $invoice["value"] . "
            </td>
            <td class='px-6 py-2 whitespace-nowrap text-center hidden lg:table-cell'>
              <p>Salut</p>
            </td>
            <td class='px-6 py-2 whitespace-nowrap text-center hidden lg:table-cell'>
            " . $invoice["totalValue"] . "
            </td>
            <td class='px-6 py-2 whitespace-nowrap text-center hidden lg:table-cell'>
            " . strtoupper($invoice["currency"]) . "
            </td>
            <td class='px-6 py-2 whitespace-nowrap text-center hidden lg:table-cell'>
            " . $invoice["status"] . "
            </td>
            <td class='px-6 py-2 whitespace-nowrap text-center'>
              <a href='?page=editInvoiceForm&id=". $invoice['id']  ."' type='button' class='bg-sky-100 px-3 rounded-md group'>
                <i
                  class='fa-solid fa-pen-to-square text-sky-900 text-lg group-hover:text-orange-600 transition-all duration-150'
                ></i>
              </a>
            </td>
          </tr>";
        }
         $content["content"] = $this->render(APP_PATH.VIEWS.'invoicespage.html', $data);
        echo $this->render(APP_PATH.VIEWS.'boilerplate.html',$content);
    }

}


 