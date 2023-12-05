<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InlineQueryResultVideo
{
    public string $type;
    public string $id;
    public string $video_url;
    public string $mime_type;
    public string $thumbnail_url;
    public string $title;
    public string $caption;
    public string $parse_mode;
    public Json|string  $caption_entities;
    public int $video_width;
    public int $video_height;
    public int $video_duration;
    public string $description;
    public Json|string $reply_markup;
    public InputMessageContent $input_message_content;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['input_message_content'])) $this->input_message_content = new InputMessageContent($update['input_message_content']);
    }
}