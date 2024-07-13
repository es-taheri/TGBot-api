<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method CreateChatInviteLink name(string $value) Invite link name; 0-32 characters
 * @method CreateChatInviteLink expire_date(int $value) Point in time (Unix timestamp) when the link will expire
 * @method CreateChatInviteLink member_limit(int $value) The maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999
 * @method CreateChatInviteLink creates_join_request(bool $value) <em>True</em>, if users joining the chat via the link need to be approved by chat administrators. If <em>True</em>, <em>member_limit</em> can&#39;t be specified
 */
class CreateChatInviteLink
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private int|string $chat_id;
    private string $name;
    private int $expire_date;
    private int $member_limit;
    private bool $creates_join_request;
    
    public function __construct(Request $request, int|string $chat_id)
    {
        $this->_request = $request;
        $this->chat_id = $chat_id;
    }

    public function __call(string $name, array $arguments)
    {
        return $this->return($name, array_shift($arguments));
    }

    public function _send(): mixed
    {
        $parameters = [];
        foreach ($this as $key => $value):
            if (isset($this->{$key}) && !in_array($key, ['_request', '_sent', '_returned'])) $parameters[$key] = $value;
        endforeach;
        $r = new \ReflectionClass($this);
        $this->_sent = true;
        return $this->_request->send(lcfirst($r->getShortName()), $parameters);
    }

    private function return($function, $value)
    {
        $class = new (static::class)($this->_request, $this->chat_id);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            if (!in_array($key, ['_sent', '_returned'])) $class->{$key} = $value;
        endforeach;
        $this->_returned = true;
        return $class;
    }

    public function __destruct()
    {
        if (!$this->_returned && !$this->_sent) $this->_send();
    }
}
