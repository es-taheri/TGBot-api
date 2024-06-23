<?php

namespace EasyTel\Types;

class MessageOriginChat
{
    public string $type;
    public int $date;
    public Chat $sender_chat;
    public string $author_signature;
    
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
        if (isset($update['sender_chat'])) $this->sender_chat = new Chat($update['sender_chat']);
    }
}