<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class Game
{
    public string $title;
    public string $description;
    public Json|string  $photo;
    public string $text;
    public Json|string  $text_entities;
    public Animation $animation;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $reflection = new \ReflectionClass(__CLASS__);
            $property = $reflection->getProperty($object);
            $type = $property->gettype()->getName();
            if (in_array(strtolower($type), ['bool', 'int', 'string', 'array', 'true', 'object', 'json|string','float']))
                $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['animation'])) $this->animation = new Animation($update['animation']);
    }
}