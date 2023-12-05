<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class VideoNote
{
    public string $file_id;
    public string $file_unique_id;
    public int $length;
    public int $duration;
    public PhotoSize $thumbnail;
    public int $file_size;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['thumbnail'])) $this->thumbnail = new PhotoSize($update['thumbnail']);
    }
}