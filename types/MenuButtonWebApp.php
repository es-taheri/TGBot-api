<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class MenuButtonWebApp
{
    public string $type;
    public string $text;
    public WebAppInfo $web_app;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['web_app'])) $this->web_app = new WebAppInfo($update['web_app']);
    }
}