<?php

namespace EasyTel;

use EasyTel\Helper\Updates;
use EasyTel\Helper\Methods;
use GuzzleHttp\Client;

class Telegram
{
    public Updates $updates;
    public Methods $methods;
    public Webhook $webhook;
    public const OUTPUT_JSON = 111;
    public const OUTPUT_OBJECT = 112;
    public const OUTPUT_ARRAY = 113;
    public int $output;

    public function __construct(
        string $TG_BOT_TOKEN, string|null $UPDATES = null, string $TG_BOTAPI_URL = 'https://api.telegram.org',
        string $TG_REQUEST_METHOD = 'POST', array $guzzle_client_options = [], string $output = self::OUTPUT_OBJECT
    )
    {
        $guzzle_client_options['base_uri'] = "$TG_BOTAPI_URL/bot$TG_BOT_TOKEN/";
        $guzzle = new Client($guzzle_client_options);
        if (!empty($UPDATES)) $this->updates = new Updates($UPDATES, $output);
        $this->methods = new Methods($guzzle, $TG_REQUEST_METHOD, $output);
        $this->webhook = new Webhook($guzzle, $TG_REQUEST_METHOD, $output);
    }
}