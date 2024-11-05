<?php

namespace EasyTel\Types;

class TransactionPartner
{
    public TransactionPartnerUser $transactionpartneruser;
    public TransactionPartnerFragment $transactionpartnerfragment;
    public TransactionPartnerTelegramAds $transactionpartnertelegramads;
    public TransactionPartnerTelegramApi $transactionpartnertelegramapi;
    public TransactionPartnerOther $transactionpartnerother;
    
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
        $this->transactionpartneruser = new TransactionPartnerUser($update);
        $this->transactionpartnerfragment = new TransactionPartnerFragment($update);
        $this->transactionpartnertelegramads = new TransactionPartnerTelegramAds($update);
        $this->transactionpartnertelegramapi = new TransactionPartnerTelegramApi($update);
        $this->transactionpartnerother = new TransactionPartnerOther($update);
    }
}