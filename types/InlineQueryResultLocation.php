<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InlineQueryResultLocation
{
    public string $type;
    public string $id;
    public float $latitude;
    public float $longitude;
    public string $title;
    public float $horizontal_accuracy;
    public int $live_period;
    public int $heading;
    public int $proximity_alert_radius;
    public Json|string $reply_markup;
    public InputMessageContent $input_message_content;
    public string $thumbnail_url;
    public int $thumbnail_width;
    public int $thumbnail_height;
    
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
        if (isset($update['input_message_content'])) $this->input_message_content = new InputMessageContent($update['input_message_content']);
    }
}