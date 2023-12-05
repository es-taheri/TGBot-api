<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ForumTopicCreated
{
    public string $name;
    public int $icon_color;
    public string $icon_custom_emoji_id;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}