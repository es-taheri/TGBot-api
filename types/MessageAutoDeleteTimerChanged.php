<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class MessageAutoDeleteTimerChanged
{
    public int $message_auto_delete_time;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}