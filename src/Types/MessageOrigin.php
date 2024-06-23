<?php

namespace EasyTel\Types;

class MessageOrigin
{
    public MessageOriginUser $messageoriginuser;
    public MessageOriginHiddenUser $messageoriginhiddenuser;
    public MessageOriginChat $messageoriginchat;
    public MessageOriginChannel $messageoriginchannel;
    
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
        $this->messageoriginuser = new MessageOriginUser($update);
        $this->messageoriginhiddenuser = new MessageOriginHiddenUser($update);
        $this->messageoriginchat = new MessageOriginChat($update);
        $this->messageoriginchannel = new MessageOriginChannel($update);
    }
}