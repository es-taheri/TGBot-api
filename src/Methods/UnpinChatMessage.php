<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method UnpinChatMessage business_connection_id(string $value) Unique identifier of the business connection on behalf of which the message will be unpinned
 * @method UnpinChatMessage message_id(int $value) Identifier of the message to unpin. Required if <em>business_connection_id</em> is specified. If not specified, the most recent pinned message (by sending date) will be unpinned.
 */
class UnpinChatMessage
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private int|string $chat_id;
    private string $business_connection_id;
    private int $message_id;

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
