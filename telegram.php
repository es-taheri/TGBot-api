<?php

namespace EasyTel;

use EasyTel\core\methods;
use EasyTel\core\updates;
use Nette\Utils\Json;

class telegram
{
    public updates $updates;
    public methods $methods;
    public const OUTPUT_JSON = 111;
    public const OUTPUT_OBJECT = 112;
    public const OUTPUT_ARRAY = 113;

    public function __construct(
        string $TG_BOT_TOKEN, Json|string $UPDATES, string $TG_BOTAPI_URL = 'https://api.telegram.org',
        string $TG_REQUEST_METHOD = 'POST', int $TG_REQUEST_TIMEOUT = 5, string $output = self::OUTPUT_OBJECT
    )
    {
        $this->updates = new updates($UPDATES, $output);
        $this->methods = new methods($TG_BOT_TOKEN, $TG_BOTAPI_URL, $TG_REQUEST_METHOD, $TG_REQUEST_TIMEOUT, $output);
    }

    public static function getUpdates(
        string $bot_token, string $botapi_url = 'https://api.telegram.org', string $method = 'POST',
        int    $request_timeout = 5, string $output = self::OUTPUT_OBJECT, int $offset = null, int $limit = null,
        int    $timeout = null, Json|string $allowed_updates = null
    ): mixed
    {
        $methods=new methods($bot_token, $botapi_url, $method, $request_timeout,$output);
        return $methods->getUpdates($offset,$limit,$timeout,$allowed_updates);
    }
}