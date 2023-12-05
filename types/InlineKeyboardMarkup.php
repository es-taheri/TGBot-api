<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InlineKeyboardMarkup
{
    public Json|string  $inline_keyboard;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}