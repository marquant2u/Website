<?php

session_start();

include_once 'vendor/autoload.php'; 

date_default_timezone_set('Europe/Paris');
// Decallage horaire entre UTC et GMT Europe Paris en seconde
define('Decalage_horaire', -7200);

use Illuminate\Database\Capsule\Manager as DB;
use conf\Eloquent;
use Controllers\ControllerHome;
use \Psr\Http\Message\ServerRequestInterface as ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface as ResponseInterface;


Eloquent::init('src/conf/db-final.ini');


$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => true,
        'debug' => true,
        'log.enabled' => true
    ]
]);

$app->add(function(Slim\Http\Request $request, Slim\Http\Response $response, callable $next){
    $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');
	$response = $response->withHeader('Access-Control-Allow-Methods', 'OPTION, GET, POST, PUT, PATCH, DELETE');
    $response = $response->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization');
	return $next($request, $response);
});


$container = $app->getContainer();

$container['view'] = function($container){
    $view = new \Slim\Views\Twig(__DIR__  . '/resources/views', [
    //$view = new \Slim\Views\Twig(__DIR__  . '\resources\views', [
        'cache' => false,
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()

    ));	

    return $view;
};


$container['ControllerHome'] = function($container){
    return new ControllerHome($container);
};



$container['view']['session'] = $_SESSION;
//$container['view']['base_url'] = '/website/';
$container['view']['base_url'] = 'https://www.lmwebdev.fr/';


//Ajout des middleware
/*
$middleware_need_co = function ($request, $response, $next) {
    if(!isset($_SESSION['id'])){
        return $response->withRedirect($this->router->pathFor('signin'));
    }else {
        return $next($request, $response);
    }

};

$middleware_already_co =function ($request, $response, $next) {
    if(isset($_SESSION['id'])){
        return $response->withRedirect($this->router->pathFor('home'));
    }else {
        return $next($request, $response);

    }
};
*/


$app->get('/', 'ControllerHome:home')->setName('home');
$app->get('/prestation_tarif', 'ControllerHome:prestation')->setName('presta');
$app->get('/contact', 'ControllerHome:contact')->setName('contact');
$app->post('/send', 'ControllerHome:sendmessage')->setName('send');


$app->run();
