<?php

namespace EasyTel\Types;

class InputMediaPhoto
{
    public string $type;
    public string $media;
    public string $caption;
    public string $parse_mode;
    public array  $caption_entities;
    public bool $show_caption_above_media;
    public bool $has_spoiler;
    
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