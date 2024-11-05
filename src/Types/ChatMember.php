<?php

namespace EasyTel\Types;

class ChatMember
{
    public ChatMemberOwner $chatmemberowner;
    public ChatMemberAdministrator $chatmemberadministrator;
    public ChatMemberMember $chatmembermember;
    public ChatMemberRestricted $chatmemberrestricted;
    public ChatMemberLeft $chatmemberleft;
    public ChatMemberBanned $chatmemberbanned;
    
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
        $this->chatmemberowner = new ChatMemberOwner($update);
        $this->chatmemberadministrator = new ChatMemberAdministrator($update);
        $this->chatmembermember = new ChatMemberMember($update);
        $this->chatmemberrestricted = new ChatMemberRestricted($update);
        $this->chatmemberleft = new ChatMemberLeft($update);
        $this->chatmemberbanned = new ChatMemberBanned($update);
    }
}