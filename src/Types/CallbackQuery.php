<?php

namespace EasyTel\Types;

class CallbackQuery
{
    public string $id;
    public User $from;
    public MaybeInaccessibleMessage $message;
    public string $inline_message_id;
    public string $chat_instance;
    public string $data;
    public string $game_short_name;
    
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
        if (isset($update['from'])) $this->from = new User($update['from']);
        if (isset($update['message'])) $this->message = new MaybeInaccessibleMessage($update['message']);
    }
}