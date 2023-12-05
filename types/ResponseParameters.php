<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ResponseParameters
{
    public int $migrate_to_chat_id;
    public int $retry_after;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}