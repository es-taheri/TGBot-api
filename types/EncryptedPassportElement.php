<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class EncryptedPassportElement
{
    public string $type;
    public string $data;
    public string $phone_number;
    public string $email;
    public Json|string  $files;
    public PassportFile $front_side;
    public PassportFile $reverse_side;
    public PassportFile $selfie;
    public Json|string  $translation;
    public string $hash;
    
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
        if (isset($update['front_side'])) $this->front_side = new PassportFile($update['front_side']);
        if (isset($update['reverse_side'])) $this->reverse_side = new PassportFile($update['reverse_side']);
        if (isset($update['selfie'])) $this->selfie = new PassportFile($update['selfie']);
    }
}