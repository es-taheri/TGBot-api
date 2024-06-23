<?php

namespace EasyTel\Types;

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
    public array  $allowed_updates;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        $r = new \ReflectionClass(static::class);
        foreach ($objects as $object):
            if ($r->hasProperty($object)):
                $prop = $r->getProperty($object);
                $type = $prop->getType();
                if (in_array($type, ['mixed', 'True', 'string', 'bool', 'int', 'float', 'array'])) $this->{$object} = $update[$object];
            endif;
        endforeach;
        
    }
}