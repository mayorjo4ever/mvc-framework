<?php

namespace app\core\form;

/**
 * Description of TextareaField
 *
 * @author User
 */
class TextareaField extends BaseField{
    
    //put your code here
    public function renderInput(): string {
         return sprintf('<textarea name="%s" class="form-control %s">%s</textarea>',           
            $this->attribute,
            $this->model->hasError($this->attribute) ? ' is-invalid':'is-valid' ,
            $this->model->{$this->attribute}                       
            );
    }
    
    public function __toString() { 
      return  sprintf('
         <div class="form-group">
          <label class="form-label">%s </label>
          <textarea name="%s" class="form-control %s">%s</textarea>          
          <div class="invalid-feedback">%s</div>
        </div>',
              $this->model->getLabel($this->attribute),             
              $this->attribute,
               $this->model->hasError($this->attribute) ? ' is-invalid':'is-valid' ,
              $this->model->{$this->attribute},             
              $this->model->getFirstError($this->attribute)
            );
     }

}
