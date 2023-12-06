<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InputMediaPhoto
{
    public string $type;
    public string $media;
    public string $caption;
    public string $parse_mode;
    public Json|string  $caption_entities;
    public bool $has_spoiler;
    
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
    }
}