<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InputTextMessageContent
{
    public string $message_text;
    public string $parse_mode;
    public Json|string  $entities;
    public bool $disable_web_page_preview;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}