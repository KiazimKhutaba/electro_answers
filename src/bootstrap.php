<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DI\Container;
use Dotenv\Dotenv;
use Http\AnswersController;
use Http\UsageCounterController;
use Repository\UsageCounterRepository;
use Service\VoiceService;
use Repository\AnswerRepository;
use Slim\Factory\AppFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

set_exception_handler(function($e) {

    $message = [
        'file' => $e->getFile(), 
        'line' => $e->getLine(),
        'error' => $e->getMessage()
    ];

    print json_encode($message, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
});


$dotenv = Dotenv::createImmutable(__DIR__ . '/../', '.env.local');
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

$container->set(UsageCounterRepository::class, function () use ($container) {
   return new UsageCounterRepository($container->get(PDO::class));
});

$container->set(UsageCounterController::class, function () use ($container) {
    $repository = $container->get(UsageCounterRepository::class);
    $controller = new UsageCounterController($repository);
    $controller->setRenderer($container->get(\Service\TwigService::class));
    return $controller;
});

$container->set(AnswersController::class, function () use($container) {
    $repository = $container->get(AnswerRepository::class);
    return new AnswersController($repository);
});

$container->set(\Http\HomeController::class, function () use($container) {
    return new \Http\HomeController();
});

$container->set(\Service\TwigService::class, function () {

    $loader = new FilesystemLoader(__DIR__ . '/../resources/views/');
    return new Environment($loader, [
        'cache' => __DIR__ . '/../var/.cache'
    ]);
});

AppFactory::setContainer($container);


