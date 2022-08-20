<?php

namespace Http;

use Repository\AnswerRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Repository\UsageCounterRepository;


class AnswersController
{
    private AnswerRepository $repository;


    public function __construct(AnswerRepository $repository)
    {
        $this->repository = $repository;
    }


    public function getRandom(Request $request, Response $response): Response
    {
        $answers = $this->repository->getRandom(5);
        $json = to_json($answers);

        $response->getBody()->write($json);
        return $response->withHeader('Content-Type', 'application/json');
    }


    public function getAll(Request $request, Response $response): Response
    {
        $answers = $this->repository->getAll(5);
        $json = to_json($answers);

        $response->getBody()->write($json);
        return $response->withHeader('Content-Type', 'application/json');
    }
}