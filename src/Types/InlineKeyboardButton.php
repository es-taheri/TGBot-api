<?php

namespace EasyTel\Types;

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
        $r = new \ReflectionClass(static::class);
        foreach ($objects as $object):
            if ($r->hasProperty($object)):
                $prop = $r->getProperty($object);
                $type = $prop->getType();
                if (in_array($type, ['mixed', 'True', 'string', 'bool', 'int', 'float', 'array'])) $this->{$object} = $update[$object];
            endif;
        endforeach;
        if (isset($update['web_app'])) $this->web_app = new WebAppInfo($update['web_app']);
        if (isset($update['login_url'])) $this->login_url = new LoginUrl($update['login_url']);
        if (isset($update['switch_inline_query_chosen_chat'])) $this->switch_inline_query_chosen_chat = new SwitchInlineQueryChosenChat($update['switch_inline_query_chosen_chat']);
        if (isset($update['callback_game'])) $this->callback_game = new CallbackGame($update['callback_game']);
    }
}