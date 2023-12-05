<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InlineQueryResultContact
{
    public string $type;
    public string $id;
    public string $phone_number;
    public string $first_name;
    public string $last_name;
    public string $vcard;
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