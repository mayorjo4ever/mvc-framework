<?php

namespace app\core\form;

use app\core\Model;

/**
 * Description of BaseField
 *
 * @author User
 */
abstract class BaseField {
      
    public Model $model; 
    public string $attribute; 
    abstract public function renderInput(): string;
       
       public function __construct(Model $model, string $attribute) {        
        $this->model = $model; 
        $this->attribute = $attribute; 
     }
     
     
    
}
