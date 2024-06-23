<?php

namespace EasyTel\Types;

class InlineQueryResultArticle
{
    public string $type;
    public string $id;
    public string $title;
    public InputMessageContent $input_message_content;
    public InlineKeyboardMarkup $reply_markup;
    public string $url;
    public bool $hide_url;
    public string $description;
    public string $thumbnail_url;
    public int $thumbnail_width;
    public int $thumbnail_height;
    
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
        if (isset($update['input_message_content'])) $this->input_message_content = new InputMessageContent($update['input_message_content']);
        if (isset($update['reply_markup'])) $this->reply_markup = new InlineKeyboardMarkup($update['reply_markup']);
    }
}