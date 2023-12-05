<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ShippingQuery
{
    public string $id;
    public User $from;
    public string $invoice_payload;
    public ShippingAddress $shipping_address;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['from'])) $this->from = new User($update['from']);
        if (isset($update['shipping_address'])) $this->shipping_address = new ShippingAddress($update['shipping_address']);
    }
}