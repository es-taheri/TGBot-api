<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class LoginUrl
{
    public string $url;
    public string $forward_text;
    public string $bot_username;
    public bool $request_write_access;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}