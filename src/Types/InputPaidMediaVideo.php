<?php

namespace EasyTel\Types;

class InputPaidMediaVideo
{
    public string $type;
    public string $media;
    public mixed $thumbnail;
    public int $width;
    public int $height;
    public int $duration;
    public bool $supports_streaming;
    
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