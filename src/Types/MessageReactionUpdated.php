<?php

namespace EasyTel\Types;

class MessageReactionUpdated
{
    public Chat $chat;
    public int $message_id;
    public User $user;
    public Chat $actor_chat;
    public int $date;
    public array  $old_reaction;
    public array  $new_reaction;
    
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
        if (isset($update['user'])) $this->user = new User($update['user']);
        if (isset($update['actor_chat'])) $this->actor_chat = new Chat($update['actor_chat']);
    }
}