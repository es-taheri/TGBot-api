<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InlineQueryResultMpeg4Gif
{
    public string $type;
    public string $id;
    public string $mpeg4_url;
    public int $mpeg4_width;
    public int $mpeg4_height;
    public int $mpeg4_duration;
    public string $thumbnail_url;
    public string $thumbnail_mime_type;
    public string $title;
    public string $caption;
    public string $parse_mode;
    public Json|string  $caption_entities;
    public Json|string $reply_markup;
    public InputMessageContent $input_message_content;
    
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