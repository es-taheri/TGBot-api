<?php

namespace EasyTel\Types;

class InlineQuery
{
    public string $id;
    public User $from;
    public string $query;
    public string $offset;
    public string $chat_type;
    public Location $location;
    
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
        if (isset($update['from'])) $this->from = new User($update['from']);
        if (isset($update['location'])) $this->location = new Location($update['location']);
    }
}