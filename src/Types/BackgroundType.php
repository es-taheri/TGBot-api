<?php

namespace EasyTel\Types;

class BackgroundType
{
    public BackgroundTypeFill $backgroundtypefill;
    public BackgroundTypeWallpaper $backgroundtypewallpaper;
    public BackgroundTypePattern $backgroundtypepattern;
    public BackgroundTypeChatTheme $backgroundtypechattheme;
    
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
        $this->backgroundtypefill = new BackgroundTypeFill($update);
        $this->backgroundtypewallpaper = new BackgroundTypeWallpaper($update);
        $this->backgroundtypepattern = new BackgroundTypePattern($update);
        $this->backgroundtypechattheme = new BackgroundTypeChatTheme($update);
    }
}