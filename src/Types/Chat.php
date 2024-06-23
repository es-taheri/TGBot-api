<?php

namespace EasyTel\Types;

class Chat
{
    public int $id;
    public string $type;
    public string $title;
    public string $username;
    public string $first_name;
    public string $last_name;
    public True $is_forum;
    
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