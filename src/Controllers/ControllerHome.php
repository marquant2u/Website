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

    public function prestation($request, $response){
        return $this->view->render($response, 'presta.twig');   

    }

    public function contact($request, $response){
        return $this->view->render($response, 'contact.twig');   

    }

    public function sendmessage($request, $response){

        $to      = 'lucas.marquant54@gmail.com';
        $subject = 'Contact from LMWebDev.fr';
        $message = $_POST['message'];
        $headers = "From: ".$_POST['name']."<".$_POST['email'].">\r\n";
        $test = "lol";
        mail($to, $subject, $message, $headers);

        return $this->view->render($response, 'contact.twig', ["send"=> $test]);


    }

    public function test($request, $response){
        
        return $this->view->render($response, 'test.twig');
    }

}
