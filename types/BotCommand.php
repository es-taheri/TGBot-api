<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class BotCommand
{
    public string $command;
    public string $description;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}