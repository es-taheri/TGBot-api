<?php

namespace EasyTel\Types;

class InputTextMessageContent
{
    public string $message_text;
    public string $parse_mode;
    public array  $entities;
    public LinkPreviewOptions $link_preview_options;
    
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
        if (isset($update['link_preview_options'])) $this->link_preview_options = new LinkPreviewOptions($update['link_preview_options']);
    }
}