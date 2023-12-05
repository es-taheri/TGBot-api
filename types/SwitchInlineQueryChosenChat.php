<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class SwitchInlineQueryChosenChat
{
    public string $query;
    public bool $allow_user_chats;
    public bool $allow_bot_chats;
    public bool $allow_group_chats;
    public bool $allow_channel_chats;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}