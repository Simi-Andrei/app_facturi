<?php

class EditClientFormController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {

        $data['test'] = $_GET['id'];


        $content["content"] = $this->render(APP_PATH . VIEWS . 'editClientPage.html', $data);
        echo $this->render(APP_PATH . VIEWS . 'boilerplate.html', $content);
}

}
