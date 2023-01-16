<?php

class HomeNAuthController extends AppController
{
    public function __construct(){
        $this->init();
    }

    public function init(){


    
        $data["mesaj"]="Introdu userul si parola";
        $data["content"] = $this->render(APP_PATH.VIEWS.'homepage.html');
        echo $this->render(APP_PATH.VIEWS.'boilerplate.html',$data);
    }
}