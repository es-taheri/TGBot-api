<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InlineQuery
{
    public string $id;
    public User $from;
    public string $query;
    public string $offset;
    public string $chat_type;
    public Location $location;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['from'])) $this->from = new User($update['from']);
        if (isset($update['location'])) $this->location = new Location($update['location']);
    }
}