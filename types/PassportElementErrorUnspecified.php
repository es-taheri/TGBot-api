<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class PassportElementErrorUnspecified
{
    public string $source;
    public string $type;
    public string $element_hash;
    public string $message;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}