<?php

namespace EasyTel\Types;

class ChatBoostSourceGiveaway
{
    public string $source;
    public int $giveaway_message_id;
    public User $user;
    public int $prize_star_count;
    public True $is_unclaimed;
    
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