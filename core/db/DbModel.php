<?php

namespace app\core\db;

use app\core\Application;
use app\core\Model;


abstract class DbModel extends Model {
    //put your code here
    abstract public static function tableName(): string;
    abstract public function attributes(): array;
    abstract public static function primaryKey(): string;
    
    public function save() {
       $tableName = $this->tableName();
       $attributes = $this->attributes(); 
       $params = array_map(fn($attr)=> ":$attr",$attributes);
       $stmt = self::prepare("INSERT INTO $tableName (". implode(',', $attributes).") VALUES( ". implode(',', $params).")");
       //
       foreach ($attributes as $attribute){
           $stmt->bindValue(":$attribute", $this->{$attribute}); 
       }
       
       $stmt->execute(); 
       return true; 
       // var_dump($stmt, $params, $attributes); 
    }
    
    public static function findOne($where) { // ['email'=>'mayorjo@yahoo.com']
        $tableName = static::tableName();
        $attributes = array_keys($where); 
        // generate select string 
        $sql = implode(" AND ",array_map(fn($attr)=>"$attr =:$attr", $attributes));
        $stmt = self::prepare("SELECT * FROM $tableName WHERE $sql"); 
        foreach ($where as $key=>$item){
            $stmt->bindValue(":$key", $item);
        }
        $stmt->execute(); 
        
        return $stmt->fetchObject(static::class);
        
    }
    
    public static function prepare($sql) {
        return Application::$app->db->pdo->prepare($sql); 
    }
}
