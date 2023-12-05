<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InputMediaAudio
{
    public string $type;
    public string $media;
    public mixed $thumbnail;
    public string $caption;
    public string $parse_mode;
    public Json|string  $caption_entities;
    public int $duration;
    public string $performer;
    public string $title;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}