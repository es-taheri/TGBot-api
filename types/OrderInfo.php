<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class OrderInfo
{
    public string $name;
    public string $phone_number;
    public string $email;
    public ShippingAddress $shipping_address;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $reflection = new \ReflectionClass(__CLASS__);
            $property = $reflection->getProperty($object);
            $type = $property->gettype()->getName();
            if (in_array(strtolower($type), ['bool', 'int', 'string', 'array', 'true', 'object', 'json|string','float']))
                $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['shipping_address'])) $this->shipping_address = new ShippingAddress($update['shipping_address']);
    }
}