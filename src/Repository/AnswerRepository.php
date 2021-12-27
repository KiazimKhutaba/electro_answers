<?php

namespace Repository;

class AnswerRepository
{
    /** @var \PDO */
    private $pdo;


    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function getAll() {

        $stmt = $this->pdo->query('SELECT * FROM subject_answers');
        $answers = $stmt->fetchAll();
    
        return $answers;
    }


    public function getRandom(int $qnt = 5) {

        $func = [ 'mysql' => 'rand()', 'pgsql' => 'random()' ];
        $driver = $_ENV['DB_DRIVER'];

        $sql = "SELECT id, answer_text as atext, complexity 
                FROM subject_answers ORDER BY {$func[$driver]} LIMIT 5";

        $stmt = $this->pdo->query($sql);
        $answers = $stmt->fetchAll();
    
        return $answers;
    }
}