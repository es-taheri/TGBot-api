<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InlineKeyboardButton
{
    public string $text;
    public string $url;
    public string $callback_data;
    public WebAppInfo $web_app;
    public LoginUrl $login_url;
    public string $switch_inline_query;
    public string $switch_inline_query_current_chat;
    public SwitchInlineQueryChosenChat $switch_inline_query_chosen_chat;
    public CallbackGame $callback_game;
    public bool $pay;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $reflection = new \ReflectionClass(__CLASS__);
            $property = $reflection->getProperty($object);
            $type = $property->gettype()->getName();
            if (in_array(strtolower($type), ['bool', 'int', 'string', 'array', 'true', 'object', 'json|string','float']))
                $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['web_app'])) $this->web_app = new WebAppInfo($update['web_app']);
        if (isset($update['login_url'])) $this->login_url = new LoginUrl($update['login_url']);
        if (isset($update['switch_inline_query_chosen_chat'])) $this->switch_inline_query_chosen_chat = new SwitchInlineQueryChosenChat($update['switch_inline_query_chosen_chat']);
        if (isset($update['callback_game'])) $this->callback_game = new CallbackGame($update['callback_game']);
    }
}