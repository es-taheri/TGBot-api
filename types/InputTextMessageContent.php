<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InputTextMessageContent
{
    public string $message_text;
    public string $parse_mode;
    public Json|string  $entities;
    public bool $disable_web_page_preview;
    
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