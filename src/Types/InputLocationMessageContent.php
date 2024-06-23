<?php

namespace EasyTel\Types;

class InputLocationMessageContent
{
    public float $latitude;
    public float $longitude;
    public float $horizontal_accuracy;
    public int $live_period;
    public int $heading;
    public int $proximity_alert_radius;
    
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
        
    }
}