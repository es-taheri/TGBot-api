<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class GameHighScore
{
    public int $position;
    public User $user;
    public int $score;
    
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