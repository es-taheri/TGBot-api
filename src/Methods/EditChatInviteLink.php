<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method EditChatInviteLink name(string $value) Invite link name; 0-32 characters
 * @method EditChatInviteLink expire_date(int $value) Point in time (Unix timestamp) when the link will expire
 * @method EditChatInviteLink member_limit(int $value) The maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999
 * @method EditChatInviteLink creates_join_request(bool $value) <em>True</em>, if users joining the chat via the link need to be approved by chat administrators. If <em>True</em>, <em>member_limit</em> can&#39;t be specified */
class EditChatInviteLink
{
    private Request $request;
    private int|string $chat_id;
    private string $invite_link;
    private string $name;
    private int $expire_date;
    private int $member_limit;
    private bool $creates_join_request;
    public function __construct(Request $request, int|string $chat_id, string $invite_link)
    {
        $this->request = $request;
        $this->chat_id = $chat_id;
        $this->invite_link = $invite_link;
    }

    public function __call(string $name, array $arguments)
    {
        return $this->return($name, array_shift($arguments));
    }

    public function _send(): mixed
    {
        $parameters = [];
        foreach ($this as $key => $value):
            if (isset($this->{$key}) && $key != 'request') $parameters[$key] = $value;
        endforeach;
        $r = new \ReflectionClass($this);
        return $this->request->send(lcfirst($r->getShortName()), $parameters);
    }

    private function return($function, $value)
    {
        $class = new (static::class)($this->request, $this->chat_id, $this->invite_link);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
