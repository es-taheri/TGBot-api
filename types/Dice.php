<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class Dice
{
    public string $emoji;
    public int $value;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}