<?php

namespace EasyTel\Types;

class InlineQueryResultContact
{
    public string $type;
    public string $id;
    public string $phone_number;
    public string $first_name;
    public string $last_name;
    public string $vcard;
    public InlineKeyboardMarkup $reply_markup;
    public InputMessageContent $input_message_content;
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
        if (isset($update['reply_markup'])) $this->reply_markup = new InlineKeyboardMarkup($update['reply_markup']);
        if (isset($update['input_message_content'])) $this->input_message_content = new InputMessageContent($update['input_message_content']);
    }
}