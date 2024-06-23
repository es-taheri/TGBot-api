<?php

namespace EasyTel\Types;

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