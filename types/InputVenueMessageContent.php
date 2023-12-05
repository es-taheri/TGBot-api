<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InputVenueMessageContent
{
    public Float $latitude;
    public Float $longitude;
    public string $title;
    public string $address;
    public string $foursquare_id;
    public string $foursquare_type;
    public string $google_place_id;
    public string $google_place_type;
    
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