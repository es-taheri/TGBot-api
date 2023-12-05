<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ProximityAlertTriggered
{
    public User $traveler;
    public User $watcher;
    public int $distance;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['traveler'])) $this->traveler = new User($update['traveler']);
        if (isset($update['watcher'])) $this->watcher = new User($update['watcher']);
    }
}