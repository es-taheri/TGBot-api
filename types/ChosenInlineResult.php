<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ChosenInlineResult
{
    public string $result_id;
    public User $from;
    public Location $location;
    public string $inline_message_id;
    public string $query;
    
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