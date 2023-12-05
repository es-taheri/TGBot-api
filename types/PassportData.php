<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class PassportData
{
    public Json|string  $data;
    public EncryptedCredentials $credentials;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['credentials'])) $this->credentials = new EncryptedCredentials($update['credentials']);
    }
}