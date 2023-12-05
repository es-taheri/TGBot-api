<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ShippingOption
{
    public string $id;
    public string $title;
    public Json|string  $prices;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}