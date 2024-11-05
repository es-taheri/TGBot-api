<?php

namespace EasyTel\Types;

class TransactionPartnerUser
{
    public string $type;
    public User $user;
    public string $invoice_payload;
    public array  $paid_media;
    public string $paid_media_payload;
    
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
        if (isset($update['user'])) $this->user = new User($update['user']);
    }
}