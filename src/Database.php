<?php

class Database
{
    private $pdo;


    public function __construct()
    {
        //print('This is Database::class');
    }

    public static function getConnection(string $driver_type, string $host, string $db, string $user, string $pass, string $charset = 'utf8'): \PDO
    {
        //$dsn = "$type:host=$host;dbname=$db;charset=$charset";

        $opts = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];


        if("sqlite" === $driver_type) {
            $dsn = "sqlite:" . __DIR__ . "/../var/appdatabase.db";
            return new PDO($dsn, null, null, $opts);
        }

        $dsn = "$driver_type:host=$host;dbname=$db";
        $pdo = new PDO($dsn, $user, $pass, $opts);

        return $pdo;
    }
}