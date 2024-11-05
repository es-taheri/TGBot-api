<?php

namespace EasyTel\Types;

class RefundedPayment
{
    public string $currency;
    public int $total_amount;
    public string $invoice_payload;
    public string $telegram_payment_charge_id;
    public string $provider_payment_charge_id;
    
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
        
    }
}