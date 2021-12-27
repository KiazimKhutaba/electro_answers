<?php

namespace Http;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;
use function DI\string;

class JsonResponse
{
    /**
     * @var ResponseInterface
     */
    private $response;


    public function __construct(ResponseInterface $response, $content)
    {
        $response->getBody()->write($this->toJson($content));
        $response->withHeader('Content-Type', 'application/json');
        $this->response = $response;
    }

    public function getPsrResponse(): ResponseInterface
    {
        return $this->response;
    }

    private function toJson($content)
    {
        return json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function __toString()
    {
        return (string)$this->response->getBody();
    }
}