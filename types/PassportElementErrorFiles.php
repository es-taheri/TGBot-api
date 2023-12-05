<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class PassportElementErrorFiles
{
    public string $source;
    public string $type;
    public Json|string  $file_hashes;
    public string $message;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}