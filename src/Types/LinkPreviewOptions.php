<?php

namespace EasyTel\Types;

class LinkPreviewOptions
{
    public bool $is_disabled;
    public string $url;
    public bool $prefer_small_media;
    public bool $prefer_large_media;
    public bool $show_above_text;
    
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