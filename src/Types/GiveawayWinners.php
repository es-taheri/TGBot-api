<?php

namespace EasyTel\Types;

class GiveawayWinners
{
    public Chat $chat;
    public int $giveaway_message_id;
    public int $winners_selection_date;
    public int $winner_count;
    public array  $winners;
    public int $additional_chat_count;
    public int $premium_subscription_month_count;
    public int $unclaimed_prize_count;
    public True $only_new_members;
    public True $was_refunded;
    public string $prize_description;
    
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
        if (isset($update['chat'])) $this->chat = new Chat($update['chat']);
    }
}