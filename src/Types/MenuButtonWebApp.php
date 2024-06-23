<?php

namespace EasyTel\Types;

class MenuButtonWebApp
{
    public string $type;
    public string $text;
    public WebAppInfo $web_app;
    
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
        if (isset($update['web_app'])) $this->web_app = new WebAppInfo($update['web_app']);
    }
}