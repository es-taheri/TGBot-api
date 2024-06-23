<?php

namespace EasyTel\Handler;

use EasyTel\Telegram;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use JSON\json;
use Psr\Http\Message\ResponseInterface;

class Request
{
    private string $method;
    public int $output;
    private Client $guzzle;

    public function __construct(
        Client $guzzle, string $method = 'POST', $output = Telegram::OUTPUT_OBJECT
    )
    {
        $this->guzzle = $guzzle;
        $this->method = $method;
        $this->output = $output;
    }

    public function send(string $method, array $parameters)
    {
        $promise = $this->guzzle->requestAsync($this->method, "$method", [
            'form_params' => $parameters
        ]);
        return $promise->then(
            function (ResponseInterface $res) {
                $body = $res->getBody();
                return $this->output([
                    'success' => true,
                    'code' => $res->getStatusCode(),
                    'header' => $res->getHeaders(),
                    'response' => $body->getContents(),
                    'size' => $body->getSize()
                ]);
            },
            function (RequestException $err) {
                $response = [
                    'success' => false,
                    'code' => $err->getCode(),
                    'error' => $err->getMessage()
                ];
                if ($err->hasResponse())
                    $response['response'] = $err->getResponse()->getBody()->getContents();
                else
                    $response['response'] = null;
                return $this->output($response);
            }
        )->wait();
    }

    private function output(array $data)
    {
        return match ($this->output) {
            Telegram::OUTPUT_JSON => json::_out($data, true),
            Telegram::OUTPUT_OBJECT => json::_in(json::_out($data)),
            default => $data,
        };
    }
}