<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class SwitchInlineQueryChosenChat
{
    public string $query;
    public bool $allow_user_chats;
    public bool $allow_bot_chats;
    public bool $allow_group_chats;
    public bool $allow_channel_chats;
    
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