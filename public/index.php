<?php

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;
use app\models\User;
use Dotenv\Dotenv;
 
 require_once __DIR__.'/../vendor/autoload.php';
 
 $dotenv = Dotenv::createImmutable(dirname(__DIR__));
 $dotenv->load();    
 
/**
 echo "<pre>";
 var_dump(dirname(__DIR__));
 echo "<pre>"; **/
  
$config = [
    'userClass'=> User::class,
    'db'=>[ 
        'dsn'=> $_ENV['DB_DSN'],
        'user'=> $_ENV['DB_USER'],
        'password'=> $_ENV['DB_PASSWORD']
    ]
];    

 /**
 echo "<pre>";
// var_dump(dirname(__DIR__));
 var_dump($config);
 echo "<pre>"; 
 **/
 $app = new Application(dirname(__DIR__),$config);  //  

 // $app->router->get('/','home');  
 // $app->router->get('/contact', "contact");
   
    $app->router->get('/', [SiteController::class, 'home']);
    
    $app->router->get('/contact', [SiteController::class, 'contact']); 
 
   $app->router->post('/contact', [SiteController::class, 'contact']);
 

    $app->router->get('/login', [AuthController::class,'login']);
    $app->router->post('/login', [AuthController::class,'login']);
    $app->router->get('/register', [AuthController::class,'register']);
    $app->router->post('/register', [AuthController::class,'register']);
    $app->router->get('/logout', [AuthController::class,'logout']);
     $app->router->get('/profile', [AuthController::class,'profile']);
/***/
$app->run();


?>