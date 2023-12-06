<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ChatMemberUpdated
{
    public Chat $chat;
    public User $from;
    public int $date;
    public ChatMember $old_chat_member;
    public ChatMember $new_chat_member;
    public ChatInviteLink $invite_link;
    public bool $via_chat_folder_invite_link;
    
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
        if (isset($update['old_chat_member'])) $this->old_chat_member = new ChatMember($update['old_chat_member']);
        if (isset($update['new_chat_member'])) $this->new_chat_member = new ChatMember($update['new_chat_member']);
        if (isset($update['invite_link'])) $this->invite_link = new ChatInviteLink($update['invite_link']);
    }
}