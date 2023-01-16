<?php

class ShowSettingsPageController extends AppController 
{
    public function __construct(){
        $this->init();
    }

    public function init(){


        $data["content"] = $this->render(APP_PATH.VIEWS.'settingspage.html');
        echo $this->render(APP_PATH.VIEWS.'boilerplate.html',$data);
    }

}