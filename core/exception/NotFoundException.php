<?php

namespace app\core\exception;

/**
 * Description of NotFoundException
 *
 * @author User
 */
class NotFoundException extends \Exception{
    protected $code = 404; 
    protected $message = 'Page Not Found'; 
     
}
