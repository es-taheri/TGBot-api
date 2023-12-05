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
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}