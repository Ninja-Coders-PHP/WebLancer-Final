<?php
//Email - weblancer243@gmail.com
//   Password - Weblancer123@

//1. Go to https://remotemysql.com/index.html
//2. Click phpMyAdmin from the nav-bar
//3. Server name: remotemysql.com
//4. Username - gfcWers9uX
//5. Password - 9nyQxpzkvV
//6. Database Name - gfcWers9uX
//7. You will be abl to see the database same as the localhost that is all tables and everything.
//8. The only difference is it is shared by everyone.So whatever data we put all can access in their features.
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


