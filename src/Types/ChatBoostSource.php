<?php

namespace EasyTel\Types;

class ChatBoostSource
{
    public ChatBoostSourcePremium $chatboostsourcepremium;
    public ChatBoostSourceGiftCode $chatboostsourcegiftcode;
    public ChatBoostSourceGiveaway $chatboostsourcegiveaway;
    
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
        $this->chatboostsourcepremium = new ChatBoostSourcePremium($update);
        $this->chatboostsourcegiftcode = new ChatBoostSourceGiftCode($update);
        $this->chatboostsourcegiveaway = new ChatBoostSourceGiveaway($update);
    }
}