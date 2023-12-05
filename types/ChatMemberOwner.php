<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ChatMemberOwner
{
    public string $status;
    public User $user;
    public bool $is_anonymous;
    public string $custom_title;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['user'])) $this->user = new User($update['user']);
    }
}