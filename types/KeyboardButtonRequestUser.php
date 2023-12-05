<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class KeyboardButtonRequestUser
{
    public int $request_id;
    public bool $user_is_bot;
    public bool $user_is_premium;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}