<?php

namespace EasyTel\Types;

class TransactionPartnerFragment
{
    public string $type;
    public RevenueWithdrawalState $withdrawal_state;
    
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
        if (isset($update['withdrawal_state'])) $this->withdrawal_state = new RevenueWithdrawalState($update['withdrawal_state']);
    }
}