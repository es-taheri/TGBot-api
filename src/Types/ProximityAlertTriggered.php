<?php

namespace EasyTel\Types;

class ProximityAlertTriggered
{
    public User $traveler;
    public User $watcher;
    public int $distance;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        $r = new \ReflectionClass(static::class);
        foreach ($objects as $object):
            if ($r->hasProperty($object)):
                $prop = $r->getProperty($object);
                $type = $prop->getType();
                if (in_array($type, ['mixed', 'True', 'string', 'bool', 'int', 'float', 'array'])) $this->{$object} = $update[$object];
            endif;
        endforeach;
        if (isset($update['traveler'])) $this->traveler = new User($update['traveler']);
        if (isset($update['watcher'])) $this->watcher = new User($update['watcher']);
    }
}