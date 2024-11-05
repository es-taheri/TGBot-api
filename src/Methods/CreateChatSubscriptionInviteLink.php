<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method CreateChatSubscriptionInviteLink name(string $value) Invite link name; 0-32 characters
 */
class CreateChatSubscriptionInviteLink
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private int|string $chat_id;
    private int $subscription_period;
    private int $subscription_price;
    private string $name;

    public function __construct(Request $request, int|string $chat_id, int $subscription_period, int $subscription_price)
    {
        $this->_request = $request;
        $this->chat_id = $chat_id;
        $this->subscription_period = $subscription_period;
        $this->subscription_price = $subscription_price;
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
        $class = new (static::class)($this->_request, $this->chat_id, $this->subscription_period, $this->subscription_price);
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
