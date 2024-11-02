<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SendChatAction business_connection_id(string $value) Unique identifier of the business connection on behalf of which the action will be sent
 * @method SendChatAction message_thread_id(int $value) Unique identifier for the target message thread; for supergroups only
 */
class SendChatAction
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private int|string $chat_id;
    private string $action;
    private string $business_connection_id;
    private int $message_thread_id;

    public function __construct(Request $request, int|string $chat_id, string $action)
    {
        $this->_request = $request;
        $this->chat_id = $chat_id;
        $this->action = $action;
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
        $class = new (static::class)($this->_request, $this->chat_id, $this->action);
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
