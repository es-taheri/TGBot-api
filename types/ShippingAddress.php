<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ShippingAddress
{
    public string $country_code;
    public string $state;
    public string $city;
    public string $street_line1;
    public string $street_line2;
    public string $post_code;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}