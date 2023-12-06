<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class KeyboardButtonRequestChat
{
    public int $request_id;
    public bool $chat_is_channel;
    public bool $chat_is_forum;
    public bool $chat_has_username;
    public bool $chat_is_created;
    public Json|string $user_administrator_rights;
    public Json|string $bot_administrator_rights;
    public bool $bot_is_member;
    
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
        
    }
}