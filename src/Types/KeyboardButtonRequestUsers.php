<?php

namespace EasyTel\Types;

class KeyboardButtonRequestUsers
{
    public int $request_id;
    public bool $user_is_bot;
    public bool $user_is_premium;
    public int $max_quantity;
    public bool $request_name;
    public bool $request_username;
    public bool $request_photo;
    
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