<?php

namespace EasyTel\Types;

class InputSticker
{
    public mixed $sticker;
    public string $format;
    public array  $emoji_list;
    public MaskPosition $mask_position;
    public array  $keywords;
    
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
        if (isset($update['mask_position'])) $this->mask_position = new MaskPosition($update['mask_position']);
    }
}