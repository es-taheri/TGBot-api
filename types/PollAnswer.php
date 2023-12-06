<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class PollAnswer
{
    public string $poll_id;
    public Chat $voter_chat;
    public User $user;
    public Json|string  $option_ids;
    
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
        if (isset($update['voter_chat'])) $this->voter_chat = new Chat($update['voter_chat']);
        if (isset($update['user'])) $this->user = new User($update['user']);
    }
}