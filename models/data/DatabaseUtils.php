<?php

namespace com\loabten\model\data;

class DatabaseUtils {

    public static $dns = "mysql:host=localhost;dbname=senhub";
    public static $username = 'root';
    public static $password = '';

    public static function connect() {
        $options = array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);

        $db = new \PDO( self::$dns, self::$username, self::$password, $options);
        return $db;
    }

}
