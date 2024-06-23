<?php

namespace EasyTel\Types;

class EncryptedPassportElement
{
    public string $type;
    public string $data;
    public string $phone_number;
    public string $email;
    public array  $files;
    public PassportFile $front_side;
    public PassportFile $reverse_side;
    public PassportFile $selfie;
    public array  $translation;
    public string $hash;
    
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
        if (isset($update['front_side'])) $this->front_side = new PassportFile($update['front_side']);
        if (isset($update['reverse_side'])) $this->reverse_side = new PassportFile($update['reverse_side']);
        if (isset($update['selfie'])) $this->selfie = new PassportFile($update['selfie']);
    }
}