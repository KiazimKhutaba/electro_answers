<?php

namespace Repository;

class UsageCounterRepository
{
    /** @var \PDO */
    private $pdo;


    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function save(array $data): bool
    {
        $sql = 'INSERT INTO usage_statistics (device_name, device_os, device_ip, referer, requested_url, created_at)
                VALUES (:device_name, :device_os, :device_ip, :referer, :requested_url, :created_at)';

        $statement = $this->pdo->prepare($sql);
        return $statement->execute($data);
    }


    public function getAll(): array
    {
        $sql = 'SELECT * FROM usage_statistics';
        $statement = $this->pdo->query($sql);

        return $statement->fetchAll();
    }
}