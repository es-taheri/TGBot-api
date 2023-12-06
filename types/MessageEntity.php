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
            $reflection = new \ReflectionClass(__CLASS__);
            $property = $reflection->getProperty($object);
            $type = $property->gettype()->getName();
            if (in_array(strtolower($type), ['bool', 'int', 'string', 'array', 'true', 'object', 'json|string','float']))
                $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['user'])) $this->user = new User($update['user']);
    }
}