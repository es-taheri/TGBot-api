<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class InputInvoiceMessageContent
{
    public string $title;
    public string $description;
    public string $payload;
    public string $provider_token;
    public string $currency;
    public Json|string  $prices;
    public int $max_tip_amount;
    public Json|string  $suggested_tip_amounts;
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
        foreach ($objects as $object):
            $reflection = new \ReflectionClass(__CLASS__);
            $property = $reflection->getProperty($object);
            $type = $property->gettype()->getName();
            if (in_array(strtolower($type), ['bool', 'int', 'string', 'array', 'true', 'object', 'json|string','float']))
                $this->{$object} = $update[$object];
        endforeach;
    }
}