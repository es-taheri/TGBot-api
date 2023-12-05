<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InputMediaDocument
{
    public string $type;
    public string $media;
    public mixed $thumbnail;
    public string $caption;
    public string $parse_mode;
    public Json|string  $caption_entities;
    public bool $disable_content_type_detection;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}