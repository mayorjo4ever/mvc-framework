<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use app\core\Model;

/**
 * Description of ContactForm
 *
 * @author User
 */
class ContactForm extends Model {
    public string $subject='';
    public string $email='';
    public string $body='';
     
   public function rules():array {
             return [
                 'subject'=> [self::RULE_REQUIRED]  ,
                 'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
                 'body' => [self::RULE_REQUIRED]                 
                 ];
         }
    
        public function labels() :array {
            return [   
                'subject'=>'Enter your subject',
                'email' => 'Your Email',
                'body' => 'Body'                
                ];
        }
        
        public function send() {
            return true;
        }

    
}
