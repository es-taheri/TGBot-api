<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InlineQueryResultGame
{
    public string $type;
    public string $id;
    public string $game_short_name;
    public Json|string $reply_markup;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}