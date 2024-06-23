<?php

namespace EasyTel\Types;

class Giveaway
{
    public array  $chats;
    public int $winners_selection_date;
    public int $winner_count;
    public True $only_new_members;
    public True $has_public_winners;
    public string $prize_description;
    public array  $country_codes;
    public int $premium_subscription_month_count;
    
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