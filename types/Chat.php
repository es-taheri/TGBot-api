<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class Chat
{
    public int $id;
    public string $type;
    public string $title;
    public string $username;
    public string $first_name;
    public string $last_name;
    public True $is_forum;
    public ChatPhoto $photo;
    public Json|string  $active_usernames;
    public string $emoji_status_custom_emoji_id;
    public int $emoji_status_expiration_date;
    public string $bio;
    public True $has_private_forwards;
    public True $has_restricted_voice_and_video_messages;
    public True $join_to_send_messages;
    public True $join_by_request;
    public string $description;
    public string $invite_link;
    public Message $pinned_message;
    public Json|string $permissions;
    public int $slow_mode_delay;
    public int $message_auto_delete_time;
    public True $has_aggressive_anti_spam_enabled;
    public True $has_hidden_members;
    public True $has_protected_content;
    public string $sticker_set_name;
    public True $can_set_sticker_set;
    public int $linked_chat_id;
    public ChatLocation $location;
    
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
        if (isset($update['photo'])) $this->photo = new ChatPhoto($update['photo']);
        if (isset($update['pinned_message'])) $this->pinned_message = new Message($update['pinned_message']);
        if (isset($update['location'])) $this->location = new ChatLocation($update['location']);
    }
}