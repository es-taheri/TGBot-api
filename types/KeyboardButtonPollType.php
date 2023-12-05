<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class KeyboardButtonPollType
{
    public string $type;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}