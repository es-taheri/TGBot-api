<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ForceReply
{
    public True $force_reply;
    public string $input_field_placeholder;
    public bool $selective;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}