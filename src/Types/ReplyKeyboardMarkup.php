<?php

namespace EasyTel\Types;

class ReplyKeyboardMarkup
{
    public array  $keyboard;
    public bool $is_persistent;
    public bool $resize_keyboard;
    public bool $one_time_keyboard;
    public string $input_field_placeholder;
    public bool $selective;
    
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