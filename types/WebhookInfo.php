<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class WebhookInfo
{
    public string $url;
    public bool $has_custom_certificate;
    public int $pending_update_count;
    public string $ip_address;
    public int $last_error_date;
    public string $last_error_message;
    public int $last_synchronization_error_date;
    public int $max_connections;
    public Json|string  $allowed_updates;
    
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