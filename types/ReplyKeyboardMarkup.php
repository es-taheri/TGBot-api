<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ReplyKeyboardMarkup
{
    public Json|string  $keyboard;
    public bool $is_persistent;
    public bool $resize_keyboard;
    public bool $one_time_keyboard;
    public string $input_field_placeholder;
    public bool $selective;
    
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