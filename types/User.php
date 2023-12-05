<?php

namespace EasyTel\types;

use Nette\Utils\Json;

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
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}