<?php

require_once __DIR__ . '/../src/bootstrap.php';


use Http\HomeController;
use Http\JsonResponse;
use Http\UsageCounterController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Repository\AnswerRepository;
use Repository\UsageCounterRepository;
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



$app->add(function (Request $request, RequestHandlerInterface $handler): Response {

    $response = $handler->handle($request);

    $detector = new \Service\UsageCounterService();
    $data = $detector->detectBrowser();


    /**
     * @var $repo UsageCounterRepository
     */
    $repo = $this->get(UsageCounterRepository::class);
    $status = $repo->save($data);

    return $response;
});


$app->get('/stats', [UsageCounterController::class, 'getUsageList']);
$app->get('/',  [HomeController::class, 'index']);
$app->get('/api/browser', [HomeController::class, 'getBrowser']);


$app->get('/api/answers/random', [\Http\AnswersController::class, 'getRandom']);
$app->get('/api/answers', [\Http\AnswersController::class, 'getAll']);


$app->post('/api/getaudio', function(Request $request, Response $response) {

    $service = $this->get(VoiceService::class);
    $post = $request->getParsedBody();

    $text = trim($post['text']) ?: 'нет текста';
    $voiceId = intval($post['voice']) ?: 47;
    $modelId = intval($post['model']) ?: 19;

    $record = $service->getRecord($text, $voiceId, $modelId);
    $response->getBody()->write($record);
    //return $response;
    $response->getBody()->write($record);

    return $response->withHeader('Content-Type', 'audio/wav');
});


$app->run();
