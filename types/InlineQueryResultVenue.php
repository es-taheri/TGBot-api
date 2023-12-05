<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InlineQueryResultVenue
{
    public string $type;
    public string $id;
    public Float $latitude;
    public Float $longitude;
    public string $title;
    public string $address;
    public string $foursquare_id;
    public string $foursquare_type;
    public string $google_place_id;
    public string $google_place_type;
    public Json|string $reply_markup;
    public InputMessageContent $input_message_content;
    public string $thumbnail_url;
    public int $thumbnail_width;
    public int $thumbnail_height;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['latitude'])) $this->latitude = new Float($update['latitude']);
        if (isset($update['longitude'])) $this->longitude = new Float($update['longitude']);
        if (isset($update['input_message_content'])) $this->input_message_content = new InputMessageContent($update['input_message_content']);
    }
}