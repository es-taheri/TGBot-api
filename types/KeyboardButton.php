<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class KeyboardButton
{
    public string $text;
    public KeyboardButtonRequestUser $request_user;
    public KeyboardButtonRequestChat $request_chat;
    public bool $request_contact;
    public bool $request_location;
    public KeyboardButtonPollType $request_poll;
    public WebAppInfo $web_app;
    
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
        if (isset($update['request_user'])) $this->request_user = new KeyboardButtonRequestUser($update['request_user']);
        if (isset($update['request_chat'])) $this->request_chat = new KeyboardButtonRequestChat($update['request_chat']);
        if (isset($update['request_poll'])) $this->request_poll = new KeyboardButtonPollType($update['request_poll']);
        if (isset($update['web_app'])) $this->web_app = new WebAppInfo($update['web_app']);
    }
}