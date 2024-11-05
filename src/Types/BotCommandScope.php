<?php

namespace EasyTel\Types;

class BotCommandScope
{
    public BotCommandScopeDefault $botcommandscopedefault;
    public BotCommandScopeAllPrivateChats $botcommandscopeallprivatechats;
    public BotCommandScopeAllGroupChats $botcommandscopeallgroupchats;
    public BotCommandScopeAllChatAdministrators $botcommandscopeallchatadministrators;
    public BotCommandScopeChat $botcommandscopechat;
    public BotCommandScopeChatAdministrators $botcommandscopechatadministrators;
    public BotCommandScopeChatMember $botcommandscopechatmember;
    
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
        $this->botcommandscopedefault = new BotCommandScopeDefault($update);
        $this->botcommandscopeallprivatechats = new BotCommandScopeAllPrivateChats($update);
        $this->botcommandscopeallgroupchats = new BotCommandScopeAllGroupChats($update);
        $this->botcommandscopeallchatadministrators = new BotCommandScopeAllChatAdministrators($update);
        $this->botcommandscopechat = new BotCommandScopeChat($update);
        $this->botcommandscopechatadministrators = new BotCommandScopeChatAdministrators($update);
        $this->botcommandscopechatmember = new BotCommandScopeChatMember($update);
    }
}