<?php

namespace app\core;

use app\core\Application;
use app\core\middlewares\BaseMiddleWare;

class Controller{
    public string $layout = "main"; 
    public string $action = '';
    
     /** @var BaseMiddleWare[] **/
     protected array $middlewares = []; 
    

    public function setLayout($layout) {
        $this->layout = $layout;
    }
    
     public function render($view, $params=[]) {
        return Application::$app->view->renderView($view,$params);
    }
    
    public function registerMiddleWare(BaseMiddleWare $middleware) {
        $this->middlewares[] = $middleware; 
    }
    /** @var \app\core\middlewares\BaseMiddleWare[] */
    public function getMiddleWares():array {
        return $this->middlewares; 
    }
}