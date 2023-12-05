<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class PhotoSize
{
    public string $file_id;
    public string $file_unique_id;
    public int $width;
    public int $height;
    public int $file_size;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}