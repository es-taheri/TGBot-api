<?php

namespace EasyTel\Types;

class ChatMemberUpdated
{
    public Chat $chat;
    public User $from;
    public int $date;
    public ChatMember $old_chat_member;
    public ChatMember $new_chat_member;
    public ChatInviteLink $invite_link;
    public bool $via_join_request;
    public bool $via_chat_folder_invite_link;
    
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
        if (isset($update['old_chat_member'])) $this->old_chat_member = new ChatMember($update['old_chat_member']);
        if (isset($update['new_chat_member'])) $this->new_chat_member = new ChatMember($update['new_chat_member']);
        if (isset($update['invite_link'])) $this->invite_link = new ChatInviteLink($update['invite_link']);
    }
}