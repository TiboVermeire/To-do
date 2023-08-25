<?php
namespace ToDo\Framework;

class Db
{
    private static $conn;

    private function __construct() {
        // Private constructor om directe instantiatie te voorkomen
    }

    public static function getConnection()
    {
        if (self::$conn === null) {
            $host = "localhost";
            $dbname = "ToDo";
            $username = "root";
            $password = "root";

            try {
                self::$conn = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
