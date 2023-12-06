<?php

namespace EasyTel\types;

use Nette\Utils\Json;

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
        foreach ($objects as $object):
            $reflection = new \ReflectionClass(__CLASS__);
            $property = $reflection->getProperty($object);
            $type = $property->gettype()->getName();
            if (in_array(strtolower($type), ['bool', 'int', 'string', 'array', 'true', 'object', 'json|string','float']))
                $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['chat'])) $this->chat = new Chat($update['chat']);
        if (isset($update['from'])) $this->from = new User($update['from']);
        if (isset($update['invite_link'])) $this->invite_link = new ChatInviteLink($update['invite_link']);
    }
}