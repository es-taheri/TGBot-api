<?php

namespace EasyTel\Types;

class InputMediaDocument
{
    public string $type;
    public string $media;
    public mixed $thumbnail;
    public string $caption;
    public string $parse_mode;
    public array  $caption_entities;
    public bool $disable_content_type_detection;
    
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