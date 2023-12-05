<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ChatLocation
{
    public Location $location;
    public string $address;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['location'])) $this->location = new Location($update['location']);
    }
}