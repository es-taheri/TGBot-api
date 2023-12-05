<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class WriteAccessAllowed
{
    public bool $from_request;
    public string $web_app_name;
    public bool $from_attachment_menu;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}