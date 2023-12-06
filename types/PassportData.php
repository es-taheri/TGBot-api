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
            $reflection = new \ReflectionClass(__CLASS__);
            $property = $reflection->getProperty($object);
            $type = $property->gettype()->getName();
            if (in_array(strtolower($type), ['bool', 'int', 'string', 'array', 'true', 'object', 'json|string','float']))
                $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['credentials'])) $this->credentials = new EncryptedCredentials($update['credentials']);
    }
}