<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class StickerSet
{
    public string $name;
    public string $title;
    public string $sticker_type;
    public bool $is_animated;
    public bool $is_video;
    public Json|string  $stickers;
    public PhotoSize $thumbnail;
    
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
    }
}