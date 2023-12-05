<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class PassportFile
{
    public string $file_id;
    public string $file_unique_id;
    public int $file_size;
    public int $file_date;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}