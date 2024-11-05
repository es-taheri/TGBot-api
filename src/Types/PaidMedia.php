<?php

namespace EasyTel\Types;

class PaidMedia
{
    public PaidMediaPreview $paidmediapreview;
    public PaidMediaPhoto $paidmediaphoto;
    public PaidMediaVideo $paidmediavideo;
    
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
        $this->paidmediapreview = new PaidMediaPreview($update);
        $this->paidmediaphoto = new PaidMediaPhoto($update);
        $this->paidmediavideo = new PaidMediaVideo($update);
    }
}