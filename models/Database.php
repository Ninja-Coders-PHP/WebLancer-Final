<?php
//Email - weblancer243@gmail.com
//   Password - Weblancer123@


class Database
{
    //properties
    private static $user = 'gfcWers9uX';
    private static $pass = '9nyQxpzkvV';
    private static $dsn = 'mysql:host=remotemysql.com;dbname=gfcWers9uX';
    private static $dbcon;

    private function __construct()
    {
    }

    //get pdo connection
    public static function getDb(){
        if(!isset(self::$dbcon)) {
            try {
                self::$dbcon = new \PDO(self::$dsn, self::$user, self::$pass);
                self::$dbcon->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$dbcon->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);

            } catch (\PDOException $e) {
                $msg = $e->getMessage();
                include '../custom-error.php';
                exit();
            }
        }

        return self::$dbcon;
    }
}


