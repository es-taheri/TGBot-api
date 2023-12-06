<?php

namespace EasyTel\types;

use Nette\Utils\Json;

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
        foreach ($objects as $object):
            $reflection = new \ReflectionClass(__CLASS__);
            $property = $reflection->getProperty($object);
            $type = $property->gettype()->getName();
            if (in_array(strtolower($type), ['bool', 'int', 'string', 'array', 'true', 'object', 'json|string','float']))
                $this->{$object} = $update[$object];
        endforeach;
    }
}