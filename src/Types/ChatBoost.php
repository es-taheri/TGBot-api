<?php

namespace EasyTel\Types;

class ChatBoost
{
    public string $boost_id;
    public int $add_date;
    public int $expiration_date;
    public ChatBoostSource $source;
    
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
        if (isset($update['source'])) $this->source = new ChatBoostSource($update['source']);
    }
}