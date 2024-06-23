<?php

namespace EasyTel\Types;

class InputInvoiceMessageContent
{
    public string $title;
    public string $description;
    public string $payload;
    public string $provider_token;
    public string $currency;
    public array  $prices;
    public int $max_tip_amount;
    public array  $suggested_tip_amounts;
    public string $provider_data;
    public string $photo_url;
    public int $photo_size;
    public int $photo_width;
    public int $photo_height;
    public bool $need_name;
    public bool $need_phone_number;
    public bool $need_email;
    public bool $need_shipping_address;
    public bool $send_phone_number_to_provider;
    public bool $send_email_to_provider;
    public bool $is_flexible;
    
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