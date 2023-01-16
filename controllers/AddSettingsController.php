<?php

class AddSettingsController extends AppController
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
       

        $name = $_POST['name'];
        $cui = $_POST['cui'];
        $j = $_POST['j'];
        $location = $_POST['location'];
        $iban = $_POST['iban'];
        $bank = $_POST['bank'];

        $setting = new SettingsModel;

        if($setting->addSetting($name, $cui, $j, $location, $iban, $bank)){
            sleep(2);
            header('Location: ?page=settings');
        } else {
            echo "error";
        }
    }
}
