<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ChatPhoto
{
    public string $small_file_id;
    public string $small_file_unique_id;
    public string $big_file_id;
    public string $big_file_unique_id;
    
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
    }
}