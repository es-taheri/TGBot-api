<?php

namespace EasyTel\Types;

class MessageOriginUser
{
    public string $type;
    public int $date;
    public User $sender_user;
    
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
        if (isset($update['sender_user'])) $this->sender_user = new User($update['sender_user']);
    }
}