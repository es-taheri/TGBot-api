<?php

namespace EasyTel\Types;

class Game
{
    public string $title;
    public string $description;
    public array  $photo;
    public string $text;
    public array  $text_entities;
    public Animation $animation;
    
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
        if (isset($update['animation'])) $this->animation = new Animation($update['animation']);
    }
}