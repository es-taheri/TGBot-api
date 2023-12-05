<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ChatMemberBanned
{
    public string $status;
    public User $user;
    public int $until_date;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['user'])) $this->user = new User($update['user']);
    }
}