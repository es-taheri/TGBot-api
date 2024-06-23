<?php

namespace EasyTel\Types;

class InlineQueryResultCachedMpeg4Gif
{
    public string $type;
    public string $id;
    public string $mpeg4_file_id;
    public string $title;
    public string $caption;
    public string $parse_mode;
    public array  $caption_entities;
    public bool $show_caption_above_media;
    public InlineKeyboardMarkup $reply_markup;
    public InputMessageContent $input_message_content;
    
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
        if (isset($update['reply_markup'])) $this->reply_markup = new InlineKeyboardMarkup($update['reply_markup']);
        if (isset($update['input_message_content'])) $this->input_message_content = new InputMessageContent($update['input_message_content']);
    }
}