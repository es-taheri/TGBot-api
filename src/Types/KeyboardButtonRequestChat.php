<?php

namespace EasyTel\Types;

class KeyboardButtonRequestChat
{
    public int $request_id;
    public bool $chat_is_channel;
    public bool $chat_is_forum;
    public bool $chat_has_username;
    public bool $chat_is_created;
    public ChatAdministratorRights $user_administrator_rights;
    public ChatAdministratorRights $bot_administrator_rights;
    public bool $bot_is_member;
    public bool $request_title;
    public bool $request_username;
    public bool $request_photo;
    
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
        if (isset($update['user_administrator_rights'])) $this->user_administrator_rights = new ChatAdministratorRights($update['user_administrator_rights']);
        if (isset($update['bot_administrator_rights'])) $this->bot_administrator_rights = new ChatAdministratorRights($update['bot_administrator_rights']);
    }
}