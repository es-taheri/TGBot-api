<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InputSticker
{
    public mixed $sticker;
    public Json|string  $emoji_list;
    public Json|string $mask_position;
    public Json|string  $keywords;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}