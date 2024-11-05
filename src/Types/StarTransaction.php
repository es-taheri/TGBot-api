<?php

namespace EasyTel\Types;

class StarTransaction
{
    public string $id;
    public int $amount;
    public int $date;
    public TransactionPartner $source;
    public TransactionPartner $receiver;
    
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
        if (isset($update['source'])) $this->source = new TransactionPartner($update['source']);
        if (isset($update['receiver'])) $this->receiver = new TransactionPartner($update['receiver']);
    }
}