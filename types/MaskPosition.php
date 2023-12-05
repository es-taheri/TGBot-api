<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class MaskPosition
{
    public string $point;
    public float $x_shift;
    public float $y_shift;
    public float $scale;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}