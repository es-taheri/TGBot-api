<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class BotCommandScopeChat
{
    public string $type;
    public int|string $chat_id;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['chat_id'])) $this->chat_id = new int|string($update['chat_id']);
    }
}