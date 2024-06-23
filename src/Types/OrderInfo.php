<?php

namespace EasyTel\Types;

class OrderInfo
{
    public string $name;
    public string $phone_number;
    public string $email;
    public ShippingAddress $shipping_address;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        $r = new \ReflectionClass(static::class);
        foreach ($objects as $object):
            if ($r->hasProperty($object)):
                $prop = $r->getProperty($object);
                $type = $prop->getType();
                if (in_array($type, ['mixed', 'True', 'string', 'bool', 'int', 'float', 'array'])) $this->{$object} = $update[$object];
            endif;
        endforeach;
        if (isset($update['shipping_address'])) $this->shipping_address = new ShippingAddress($update['shipping_address']);
    }
}