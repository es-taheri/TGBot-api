<?php

namespace EasyTel\Types;

class Audio
{
    public string $file_id;
    public string $file_unique_id;
    public int $duration;
    public string $performer;
    public string $title;
    public string $file_name;
    public string $mime_type;
    public int $file_size;
    public PhotoSize $thumbnail;
    
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
    }
}