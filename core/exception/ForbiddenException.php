<?php
 
namespace app\core\exception;

/**
 * Description of ForbiddenExceoption
 *
 * @author User
 */
class ForbiddenException extends \Exception{
    protected $message = 'you don\'t have permission to access this page'; 
    protected $code = 403; 
    
}
