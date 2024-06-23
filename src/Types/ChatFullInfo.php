<?php

namespace EasyTel\Types;

class ChatFullInfo
{
    public int $id;
    public string $type;
    public string $title;
    public string $username;
    public string $first_name;
    public string $last_name;
    public True $is_forum;
    public int $accent_color_id;
    public int $max_reaction_count;
    public ChatPhoto $photo;
    public array  $active_usernames;
    public Birthdate $birthdate;
    public BusinessIntro $business_intro;
    public BusinessLocation $business_location;
    public BusinessOpeningHours $business_opening_hours;
    public Chat $personal_chat;
    public array  $available_reactions;
    public string $background_custom_emoji_id;
    public int $profile_accent_color_id;
    public string $profile_background_custom_emoji_id;
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
    public ChatPermissions $permissions;
    public int $slow_mode_delay;
    public int $unrestrict_boost_count;
    public int $message_auto_delete_time;
    public True $has_aggressive_anti_spam_enabled;
    public True $has_hidden_members;
    public True $has_protected_content;
    public True $has_visible_history;
    public string $sticker_set_name;
    public True $can_set_sticker_set;
    public string $custom_emoji_sticker_set_name;
    public int $linked_chat_id;
    public ChatLocation $location;
    
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
        if (isset($update['photo'])) $this->photo = new ChatPhoto($update['photo']);
        if (isset($update['birthdate'])) $this->birthdate = new Birthdate($update['birthdate']);
        if (isset($update['business_intro'])) $this->business_intro = new BusinessIntro($update['business_intro']);
        if (isset($update['business_location'])) $this->business_location = new BusinessLocation($update['business_location']);
        if (isset($update['business_opening_hours'])) $this->business_opening_hours = new BusinessOpeningHours($update['business_opening_hours']);
        if (isset($update['personal_chat'])) $this->personal_chat = new Chat($update['personal_chat']);
        if (isset($update['pinned_message'])) $this->pinned_message = new Message($update['pinned_message']);
        if (isset($update['permissions'])) $this->permissions = new ChatPermissions($update['permissions']);
        if (isset($update['location'])) $this->location = new ChatLocation($update['location']);
    }
}