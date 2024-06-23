<?php

namespace EasyTel\Types;

class InaccessibleMessage
{
    public Chat $chat;
    public int $message_id;
    public int $date;
    
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
    }
}