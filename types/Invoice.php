<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class Invoice
{
    public string $title;
    public string $description;
    public string $start_parameter;
    public string $currency;
    public int $total_amount;
    
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