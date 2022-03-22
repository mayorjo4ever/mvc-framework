<?php

namespace app\core\form;
use app\core\Model; 
/**
 * Description of Form
 *
 * @author User
 */
class Form {
    //put your code here
      //put your code here
    public static function begin($action, $method) {
        echo sprintf('<form action="%s" method="%s">',$action,$method);
        return new Form();
    }
    
     public static function end() {
        echo "</form>";
    }
    
    public function field(Model $model, $attribute) {
        return new inputField($model, $attribute);
    }
}
