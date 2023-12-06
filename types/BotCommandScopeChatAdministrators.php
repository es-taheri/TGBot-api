<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class BotCommandScopeChatAdministrators
{
    public string $type;
    public int|string $chat_id;
    
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
        if (isset($update['chat_id'])) $this->chat_id = new int|string($update['chat_id']);
    }
}