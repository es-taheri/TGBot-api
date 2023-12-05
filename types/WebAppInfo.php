<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class WebAppInfo
{
    public string $url;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}