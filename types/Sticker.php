<?php

namespace EasyTel\types;

use Nette\Utils\Json;

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
    public Json|string $mask_position;
    public string $custom_emoji_id;
    public True $needs_repainting;
    public int $file_size;
    
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
        if (isset($update['thumbnail'])) $this->thumbnail = new PhotoSize($update['thumbnail']);
        if (isset($update['premium_animation'])) $this->premium_animation = new File($update['premium_animation']);
    }
}