<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class Video
{
    public string $file_id;
    public string $file_unique_id;
    public int $width;
    public int $height;
    public int $duration;
    public PhotoSize $thumbnail;
    public string $file_name;
    public string $mime_type;
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
    }
}