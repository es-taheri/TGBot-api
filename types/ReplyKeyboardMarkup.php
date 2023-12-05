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
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}