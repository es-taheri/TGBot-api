<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class ForumTopic
{
    public int $message_thread_id;
    public string $name;
    public int $icon_color;
    public string $icon_custom_emoji_id;
    
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
    }
}