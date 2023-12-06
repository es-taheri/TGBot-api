<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InlineQueryResultCachedSticker
{
    public string $type;
    public string $id;
    public string $sticker_file_id;
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