<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InputLocationMessageContent
{
    public Float $latitude;
    public Float $longitude;
    public float $horizontal_accuracy;
    public int $live_period;
    public int $heading;
    public int $proximity_alert_radius;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['latitude'])) $this->latitude = new Float($update['latitude']);
        if (isset($update['longitude'])) $this->longitude = new Float($update['longitude']);
    }
}