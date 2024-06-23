<?php

namespace EasyTel\Types;

class GiveawayCompleted
{
    public int $winner_count;
    public int $unclaimed_prize_count;
    public Message $giveaway_message;
    
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
        if (isset($update['giveaway_message'])) $this->giveaway_message = new Message($update['giveaway_message']);
    }
}