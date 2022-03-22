<?php

 class m002_add_password_column{
     public function up(){
        $db = \app\core\Application::$app->db; 
        $SQL = "ALTER TABLE `users` ADD COLUMN `password`  varchar(255) NOT NULL AFTER `status`;";
        $db->pdo->exec($SQL); 
     }
     
      public function down(){
         $db = \app\core\Application::$app->db; 
         $SQL = "ALTER TABLE `users` DROP COLUMN `password`;";
         $db->pdo->exec($SQL); 
     }
 }

