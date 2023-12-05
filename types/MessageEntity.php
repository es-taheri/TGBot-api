<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class MessageEntity
{
    public string $type;
    public int $offset;
    public int $length;
    public string $url;
    public User $user;
    public string $language;
    public string $custom_emoji_id;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['user'])) $this->user = new User($update['user']);
    }
}