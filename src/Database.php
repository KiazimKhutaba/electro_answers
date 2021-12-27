<?php

class Database
{
    private $pdo;


    public function __construct()
    {
        //print('This is Database::class');
    }

    public static function getConnection(string $type, string $host, string $db, string $user, string $pass, string $charset = 'utf8'): \PDO
    {
        //$dsn = "$type:host=$host;dbname=$db;charset=$charset";
        $dsn = "$type:host=$host;dbname=$db";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $pdo = new PDO($dsn, $user, $pass, $opt);

        return $pdo;
    }
}