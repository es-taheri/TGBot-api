<?php

namespace EasyTel\Types;

class BackgroundFill
{
    public BackgroundFillSolid $backgroundfillsolid;
    public BackgroundFillGradient $backgroundfillgradient;
    public BackgroundFillFreeformGradient $backgroundfillfreeformgradient;
    
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
        $this->backgroundfillsolid = new BackgroundFillSolid($update);
        $this->backgroundfillgradient = new BackgroundFillGradient($update);
        $this->backgroundfillfreeformgradient = new BackgroundFillFreeformGradient($update);
    }
}