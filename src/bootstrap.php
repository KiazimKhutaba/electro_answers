<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DI\Container;
use Dotenv\Dotenv;
use Service\VoiceService;
use Repository\AnswerRepository;
use Slim\Factory\AppFactory;

set_exception_handler(function($e) {

    $message = [
        'file' => $e->getFile(), 
        'line' => $e->getLine(),
        'error' => $e->getMessage()
    ];

    print json_encode($message, JSON_PRETTY_PRINT);
});


$dotenv = Dotenv::createImmutable(__DIR__ . '/../', '.env.prod');
$dotenv->load();

$container = new Container();

$container->set(PDO::class, function() {
    return Database::getConnection($_ENV['DB_DRIVER'], $_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
});

$container->set(AnswerRepository::class, function () use ($container) {
    return new AnswerRepository($container->get(PDO::class));
});

$container->set(VoiceService::class, function () {
    return new VoiceService();
});

AppFactory::setContainer($container);


