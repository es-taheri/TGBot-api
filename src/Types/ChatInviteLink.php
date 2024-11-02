<?php

namespace EasyTel\Types;

class ChatInviteLink
{
    public string $invite_link;
    public User $creator;
    public bool $creates_join_request;
    public bool $is_primary;
    public bool $is_revoked;
    public string $name;
    public int $expire_date;
    public int $member_limit;
    public int $pending_join_request_count;
    public int $subscription_period;
    public int $subscription_price;
    
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
        if (isset($update['creator'])) $this->creator = new User($update['creator']);
    }
}