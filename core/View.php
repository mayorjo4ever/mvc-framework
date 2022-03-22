<?php

namespace app\core;

/**
 * Description of View
 *
 * @author User
 */
class View {
    public string $title='';
    
     public function renderContent($viewContent) {
        $layoutContent = $this->layoutContent();
            return str_replace('{{content}}', $viewContent, $layoutContent);
       
    }

    public function renderView($views,$params = []) {
        $viewContent = $this->renderOnlyView($views,$params);
        $layoutContent = $this->layoutContent();
        
        return str_replace('{{content}}', $viewContent, $layoutContent);
       }

    protected function layoutContent() {
       
        // $layout = Application::$app->controller->layout; // 
         $layout  = Application::$app->layout;  // 07082288610         
        ob_start(); 
        if(Application::$app->controller){
            $layout  = Application::$app->controller->layout;  
        }
       include_once Application::$ROOT_DIR. "/views/layouts/$layout.php";
       return ob_get_clean();
    }     
    
    protected function renderOnlyView($view,$params=[]) {
        foreach ($params as $key => $value){
            $$key = $value; 
        } 
        ob_start(); 
        include_once Application::$ROOT_DIR. "/views/$view.php";
        return ob_get_clean();
    }

}
