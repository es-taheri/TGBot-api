<?php

namespace EasyTel\Types;

class ReplyParameters
{
    public int $message_id;
    public int|string $chat_id;
    public bool $allow_sending_without_reply;
    public string $quote;
    public string $quote_parse_mode;
    public array  $quote_entities;
    public int $quote_position;
    
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
        
    }
}