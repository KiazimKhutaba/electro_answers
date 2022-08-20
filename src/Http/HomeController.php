<?php

namespace Http;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class HomeController
{

    public function __construct()
    {

    }


    public function index(Request $request, Response $response): Response
    {
        $content = file_get_contents(__DIR__ . '/../../resources/views/home/index.html');

        $response->getBody()->write($content);
        return $response;
    }


    public function getBrowser(Request $request, Response $response): Response
    {
        $detector = new \Service\UsageCounterService();
        $data = to_json($detector->detectBrowser(), -1);

        $response->getBody()->write($data);
        return $response->withHeader('Content-Type', 'application/json');
    }
}