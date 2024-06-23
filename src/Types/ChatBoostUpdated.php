<?php

namespace EasyTel\Types;

class ChatBoostUpdated
{
    public Chat $chat;
    public ChatBoost $boost;
    
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
        if (isset($update['chat'])) $this->chat = new Chat($update['chat']);
        if (isset($update['boost'])) $this->boost = new ChatBoost($update['boost']);
    }
}