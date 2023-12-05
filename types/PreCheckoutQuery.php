<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class PreCheckoutQuery
{
    public string $id;
    public User $from;
    public string $currency;
    public int $total_amount;
    public string $invoice_payload;
    public string $shipping_option_id;
    public OrderInfo $order_info;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['from'])) $this->from = new User($update['from']);
        if (isset($update['order_info'])) $this->order_info = new OrderInfo($update['order_info']);
    }
}