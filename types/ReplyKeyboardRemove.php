<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ReplyKeyboardRemove
{
    public True $remove_keyboard;
    public bool $selective;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}