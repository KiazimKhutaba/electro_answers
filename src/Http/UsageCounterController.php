<?php

namespace Http;

use Repository\UsageCounterRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;

class UsageCounterController
{
    private UsageCounterRepository $repository;
    private Environment $renderer;

    public function __construct(UsageCounterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function setRenderer($renderer): Environment
    {
        $this->renderer = $renderer;
    }

    public function render(string $path)
    {
        return $this->renderer->render('stats/');
    }

    public function getUsageList(Request $request, Response $response): Response
    {
        $data = $this->repository->getAll();
        $json = to_json($data, -1);

        $response->getBody()->write($json);
        return $response->withHeader('Content-Type', 'application/json');
    }
}