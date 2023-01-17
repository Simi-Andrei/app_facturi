<?php

class EditInvoiceFormController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {


        $data['test'] = $_GET['id'];

        $content["content"] = $this->render(APP_PATH . VIEWS . 'editInvoicePage.html', $data);
        echo $this->render(APP_PATH . VIEWS . 'boilerplate.html', $content);
}

}
