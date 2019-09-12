<?php

namespace Controllers;

use Slim\Views\Twig as View;
use Controllers\ControllerUser;
use Controllers\ControllerPlanning;

class ControllerHome extends Controller
{

    public function home($request, $response){
        return $this->view->render($response, 'home.twig');   
        
    }

    public function test($request, $response){
        $test = 'Serveur qui repond lentement';
        return $test;
    }

}
