<?php

namespace EasyTel\Types;

class ChatJoinRequest
{
    public Chat $chat;
    public User $from;
    public int $user_chat_id;
    public int $date;
    public string $bio;
    public ChatInviteLink $invite_link;
    
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
        if (isset($update['from'])) $this->from = new User($update['from']);
        if (isset($update['invite_link'])) $this->invite_link = new ChatInviteLink($update['invite_link']);
    }
}