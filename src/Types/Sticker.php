<?php

namespace EasyTel\Types;

class Sticker
{
    public string $file_id;
    public string $file_unique_id;
    public string $type;
    public int $width;
    public int $height;
    public bool $is_animated;
    public bool $is_video;
    public PhotoSize $thumbnail;
    public string $emoji;
    public string $set_name;
    public File $premium_animation;
    public MaskPosition $mask_position;
    public string $custom_emoji_id;
    public True $needs_repainting;
    public int $file_size;
    
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
        if (isset($update['thumbnail'])) $this->thumbnail = new PhotoSize($update['thumbnail']);
        if (isset($update['premium_animation'])) $this->premium_animation = new File($update['premium_animation']);
        if (isset($update['mask_position'])) $this->mask_position = new MaskPosition($update['mask_position']);
    }
}