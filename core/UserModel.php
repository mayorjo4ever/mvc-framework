<?php
 
namespace app\core;

use app\core\db\DbModel;

/**
 * Description of UserModel
 *
 * @author User
 */
abstract class UserModel extends DbModel {
    abstract public function getDisplayName() : string;
}
