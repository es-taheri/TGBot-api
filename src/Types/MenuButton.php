<?php

namespace EasyTel\Types;

class MenuButton
{
    public MenuButtonCommands $menubuttoncommands;
    public MenuButtonWebApp $menubuttonwebapp;
    public MenuButtonDefault $menubuttondefault;
    
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
        $this->menubuttoncommands = new MenuButtonCommands($update);
        $this->menubuttonwebapp = new MenuButtonWebApp($update);
        $this->menubuttondefault = new MenuButtonDefault($update);
    }
}