<?php

namespace app\core;

use app\core\exception\NotFoundException;

class Router{
    
    public Request $request;
    public Response $response; 
    protected array $routes = [];

    public function __construct(Request $request, Response $response) {
        $this->request = $request;        
        $this->response = $response;
    }
    
    public function get($path,$callback) {
        $this->routes['get'][$path] = $callback;
    }
    
    public function post($path,$callback) {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve() {
       $path =  $this->request->getPath();
       $method = $this->request->method();
       $callback = $this->routes[$method][$path] ?? false;
       if($callback == false){
          $this->response->setStatusCode(404);
          throw new NotFoundException();  ##return $this->renderView("_404");             
           }       
           if (is_string($callback)) {
             return Application::$app->view->renderView($callback);
               // return $this->renderView($callback);
            }
            
            if(is_array($callback)){
                /** @var Controller $controller */             
              $controller = new $callback[0]();         ## Application::$app->controller = new $callback[0](); 
              Application::$app->controller = $controller; 
              $controller->action = $callback[1];      // Application::$app->controller->action = $callback[1]; 
              $callback[0] =  $controller; // Application::$app->controller;
              // $callback[0] = new $callback[0](); 
              foreach ($controller->getMiddleWares() as $middleware){
                  $middleware->execute();
              }
            } 
            return call_user_func($callback, $this->request, $this->response);
    }
    /**
     public function renderContent($viewContent) {
        $layoutContent = $this->layoutContent();
            return str_replace('{{content}}', $viewContent, $layoutContent);
      }
**/
    /**
    public function renderView($views,$params = []) {
        return Application::$app->view->renderView($views, $params); 
        # $layoutContent = $this->layoutContent();
        # $viewContent = $this->renderOnlyView($views,$params); 
        # return str_replace('{{content}}', $viewContent, $layoutContent); 
       }**/ 
}

/*
 echo "<pre>";
       var_dump($callback);
       echo "</pre>";
 *  */