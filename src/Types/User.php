<?php

namespace EasyTel\Types;

class User
{
    public int $id;
    public bool $is_bot;
    public string $first_name;
    public string $last_name;
    public string $username;
    public string $language_code;
    public True $is_premium;
    public True $added_to_attachment_menu;
    public bool $can_join_groups;
    public bool $can_read_all_group_messages;
    public bool $supports_inline_queries;
    public bool $can_connect_to_business;
    public bool $has_main_web_app;
    
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
        
    }
}