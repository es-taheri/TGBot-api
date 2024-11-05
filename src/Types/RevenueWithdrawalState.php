<?php

namespace EasyTel\Types;

class RevenueWithdrawalState
{
    public RevenueWithdrawalStatePending $revenuewithdrawalstatepending;
    public RevenueWithdrawalStateSucceeded $revenuewithdrawalstatesucceeded;
    public RevenueWithdrawalStateFailed $revenuewithdrawalstatefailed;
    
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
        $this->revenuewithdrawalstatepending = new RevenueWithdrawalStatePending($update);
        $this->revenuewithdrawalstatesucceeded = new RevenueWithdrawalStateSucceeded($update);
        $this->revenuewithdrawalstatefailed = new RevenueWithdrawalStateFailed($update);
    }
}