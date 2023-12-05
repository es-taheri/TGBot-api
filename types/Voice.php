<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class Voice
{
    public string $file_id;
    public string $file_unique_id;
    public int $duration;
    public string $mime_type;
    public int $file_size;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}