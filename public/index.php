<?php

require_once __DIR__ . '/../src/bootstrap.php';


use Http\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Repository\AnswerRepository;
use Service\VoiceService;
use Slim\Factory\AppFactory;


function allowCors()
{
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
}


$app = AppFactory::create();


$app->add(function (Request $request, RequestHandlerInterface $handler): Response {

    $response = $handler->handle($request);

    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
    $response = $response->withHeader('Access-Control-Allow-Methods', 'GET, POST');
    $response = $response->withHeader('Access-Control-Allow-Headers', 'X-Requested-With');

    // Optional: Allow Ajax CORS requests with Authorization header
    // $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');

    return $response;
});


$app->get('/',  function (Request $request, Response $response) {
    $content = file_get_contents(__DIR__ . '/index.html');

    $response->getBody()->write($content);
    return $response;
});


$app->get('/api/answers/random', function (Request $request, Response $response) {

    $repo = $this->get(AnswerRepository::class);
    $answers = $repo->getRandom(5);
    $json = to_json($answers);

    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/api/answers', function (Request $request, Response $response) 
{
    $repo = $this->get(AnswerRepository::class);
    $answers = $repo->getAll(5);
    $json = to_json($answers);
    
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/api/getaudio', function(Request $request, Response $response) {

    $service = $this->get(VoiceService::class);
    $post = $request->getParsedBody();

    $text = trim($post['text']) ?: 'нет текста';
    $voiceId = intval($post['voice']) ?: 47;
    $modelId = intval($post['model']) ?: 19;

    $record = $service->getRecord($text, $voiceId, $modelId);
    $response->getBody()->write($record);

    return $response->withHeader('Content-Type', 'audio/wav');
});


$app->run();
