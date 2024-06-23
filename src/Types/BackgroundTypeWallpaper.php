<?php

namespace EasyTel\Types;

class BackgroundTypeWallpaper
{
    public string $type;
    public Document $document;
    public int $dark_theme_dimming;
    public True $is_blurred;
    public True $is_moving;
    
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
        if (isset($update['document'])) $this->document = new Document($update['document']);
    }
}