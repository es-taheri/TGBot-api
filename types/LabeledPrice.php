<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class LabeledPrice
{
    public string $label;
    public int $amount;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}