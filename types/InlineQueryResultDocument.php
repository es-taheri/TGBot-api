<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InlineQueryResultDocument
{
    public string $type;
    public string $id;
    public string $title;
    public string $caption;
    public string $parse_mode;
    public Json|string  $caption_entities;
    public string $document_url;
    public string $mime_type;
    public string $description;
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
        if (isset($update['input_message_content'])) $this->input_message_content = new InputMessageContent($update['input_message_content']);
    }
}