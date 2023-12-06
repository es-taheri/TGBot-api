<?php

namespace EasyTel\core;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Nette\Utils\Arrays;
use Nette\Utils\Json;
use Psr\Http\Message\ResponseInterface;
use ReflectionFunction;
use stdClass;

class webhook
{
    private string $bot_token;
    private string $method;
    public int $output;
    private Client $guzzle;
    public const OUTPUT_JSON = 111;
    public const OUTPUT_OBJECT = 112;
    public const OUTPUT_ARRAY = 113;

    public function __construct(string $bot_token, string $botapi_url = 'https://api.telegram.org', string $method = 'POST', int $timeout = 5, $output = self::OUTPUT_OBJECT)
    {
        $this->guzzle = new Client([
            'base_uri' => $botapi_url,
            'timeout' => $timeout
        ]);
        $this->bot_token = $bot_token;
        $this->method = $method;
        $this->output = $output;
    }

    /**
     * Use this method to specify a URL and receive incoming updates via an outgoing webhook.
     * Whenever there is an update for the bot, we will send an HTTPS POST request to the specified URL, containing a JSON-serialized Update.
     * In case of an unsuccessful request, we will give up after a reasonable amount of attempts. Returns True on success.
     *
     * @param string $url
     * @param mixed $certificate
     * @param string $ip_address
     * @param int $max_connections
     * @param Json|string $allowed_updates
     * @param bool $drop_pending_updates
     * @param string $secret_token
     * @return mixed
     * @link https://core.telegram.org/bots/api#setwebhook
     */
    public function setWebhook(
        string      $url, mixed $certificate = null, string $ip_address = null, int $max_connections = null,
        Json|string $allowed_updates = null, bool $drop_pending_updates = null, string $secret_token = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to remove webhook integration if you decide to switch back to getUpdates. Returns True on success.
     *
     * @param bool $drop_pending_updates
     * @return mixed
     * @link https://core.telegram.org/bots/api#deletewebhook
     */
    public function deleteWebhook(bool $drop_pending_updates = null): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get current webhook status. Requires no parameters. On success, returns a WebhookInfo object.
     * If the bot is using getUpdates, will return an object with the url field empty.
     *
     * @return mixed
     * @link https://core.telegram.org/bots/api#getwebhookinfo
     */
    public function getWebhookInfo(): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    private function getResponse($function, $params): mixed
    {
        $promise = $this->guzzle->requestAsync($this->method, '/bot' . $this->bot_token . '/' . $function, [
            'form_params' => $params
        ]);
        return $promise->then(
            function (ResponseInterface $res) {
                $body = $res->getBody();
                return [
                    'success' => true,
                    'code' => $res->getStatusCode(),
                    'header' => $res->getHeaders(),
                    'response' => $body->getContents(),
                    'size' => $body->getSize(),
                ];
            },
            function (RequestException $err) {
                $response = [
                    'success' => false,
                    'code' => $err->getCode(),
                    'error' => $err->getMessage(),
                ];
                if ($err->hasResponse())
                    $response['response'] = $err->getResponse()->getBody()->getContents();
                else
                    $response['response'] = null;
                return $response;
            }
        )->wait();
    }

    private function output($data)
    {
        switch ($this->output):
            case self::OUTPUT_JSON:
                $return = Json::encode($data, true);
            break;
            case self::OUTPUT_OBJECT:
                $return = new stdClass();
                Arrays::toObject($data, $return);
            break;
            default:
                $return = $data;
            break;
        endswitch;
        return $return;
    }

    private static function get_func_argNames($funcName): array
    {
        $f = new ReflectionFunction($funcName);
        $result = [];
        foreach ($f->getParameters() as $param) {
            $result[] = $param->name;
        }
        return $result;
    }
}