<?php

namespace EasyTel\Types;

class PollAnswer
{
    public string $poll_id;
    public Chat $voter_chat;
    public User $user;
    public array  $option_ids;
    
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
        if (isset($update['voter_chat'])) $this->voter_chat = new Chat($update['voter_chat']);
        if (isset($update['user'])) $this->user = new User($update['user']);
    }
}