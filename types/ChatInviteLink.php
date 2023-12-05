<?php

namespace EasyTel\types;

use Nette\Utils\Json;

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
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['creator'])) $this->creator = new User($update['creator']);
    }
}