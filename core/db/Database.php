<?php 

namespace app\core\db;

use app\core\Application;
use PDO;

/**
 * Description of Database
 *
 * @author User
 */
class Database {
   
    public PDO $pdo; 
    public function __construct(array $config) {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
         
        $this->pdo = new PDO($dsn,$user,$password); 
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
    }
    
    public function applyMigrations() {
        
        $this->createMigrationTable(); 
        $applieds = $this->getAppliedMigrations();
        $files = scandir(Application::$ROOT_DIR.'/migrations');
        $to_apply = array_diff($files,$applieds); 
        
        $newMigrations = [];        
             
        foreach ($to_apply as $migration){
            if($migration =='.' || $migration =='..'){
                continue;
            }
            require_once Application::$ROOT_DIR.'/migrations/'.$migration;
            $className = pathinfo($migration,PATHINFO_FILENAME);
            
            $instance  = new $className();  
                    
            $this->log(" applying migration $migration");
                 $instance->up(); 
                 $newMigrations[] = $migration; 
             $this->log("Applied Migration $migration ");
        }
        
        if(!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        }
    else {
            $this->log("All migrations have been applied");
    }
       
    }
    
    public function createMigrationTable() {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (id INT AUTO_INCREMENT PRIMARY KEY, migration VARCHAR(255), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP) ENGINE=INNODB;"); 
    }

    public function getAppliedMigrations() {
        $stmt = $this->pdo->prepare("SELECT migration FROM migrations");         
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_COLUMN); 
    }

    public function saveMigrations(array $migrations) {
        $str = implode(",", array_map(fn($m) => "('$m')",$migrations)); 
        $stmt = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str ");
        $stmt->execute();         
    }
    
    public function prepare($sql) {
        return $this->pdo->prepare($sql);
    }
    
    protected function log($message) {
        echo '['.date('Y-m-d H:i:s').'] - '.$message.PHP_EOL;
    }

}
