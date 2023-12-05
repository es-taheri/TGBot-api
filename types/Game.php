<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class Game
{
    public string $title;
    public string $description;
    public Json|string  $photo;
    public string $text;
    public Json|string  $text_entities;
    public Animation $animation;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['animation'])) $this->animation = new Animation($update['animation']);
    }
}