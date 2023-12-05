<?php

namespace EasyTel\types;

use Nette\Utils\Json;

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
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['thumbnail'])) $this->thumbnail = new PhotoSize($update['thumbnail']);
    }
}