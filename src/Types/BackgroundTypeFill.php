<?php

namespace EasyTel\Types;

class BackgroundTypeFill
{
    public string $type;
    public BackgroundFill $fill;
    public int $dark_theme_dimming;
    
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
        if (isset($update['fill'])) $this->fill = new BackgroundFill($update['fill']);
    }
}