<?php

namespace EasyTel\Types;

class MaybeInaccessibleMessage
{
    public Message $message;
    public InaccessibleMessage $inaccessiblemessage;
    
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
        $this->message = new Message($update);
        $this->inaccessiblemessage = new InaccessibleMessage($update);
    }
}