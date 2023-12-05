<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class File
{
    public string $file_id;
    public string $file_unique_id;
    public int $file_size;
    public string $file_path;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}