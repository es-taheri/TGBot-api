<?php

namespace EasyTel\Types;

class KeyboardButton
{
    public string $text;
    public KeyboardButtonRequestUsers $request_users;
    public KeyboardButtonRequestChat $request_chat;
    public bool $request_contact;
    public bool $request_location;
    public KeyboardButtonPollType $request_poll;
    public WebAppInfo $web_app;
    
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
        if (isset($update['request_users'])) $this->request_users = new KeyboardButtonRequestUsers($update['request_users']);
        if (isset($update['request_chat'])) $this->request_chat = new KeyboardButtonRequestChat($update['request_chat']);
        if (isset($update['request_poll'])) $this->request_poll = new KeyboardButtonPollType($update['request_poll']);
        if (isset($update['web_app'])) $this->web_app = new WebAppInfo($update['web_app']);
    }
}