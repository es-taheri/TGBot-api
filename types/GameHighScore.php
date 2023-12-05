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
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['user'])) $this->user = new User($update['user']);
    }
}