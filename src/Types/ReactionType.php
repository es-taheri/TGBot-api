<?php

namespace EasyTel\Types;

class ReactionType
{
    public ReactionTypeEmoji $reactiontypeemoji;
    public ReactionTypeCustomEmoji $reactiontypecustomemoji;
    
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
        $this->reactiontypeemoji = new ReactionTypeEmoji($update);
        $this->reactiontypecustomemoji = new ReactionTypeCustomEmoji($update);
    }
}