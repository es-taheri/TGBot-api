<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method ForwardMessages message_thread_id(int $value) Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
 * @method ForwardMessages disable_notification(bool $value) Sends the messages <a href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a notification with no sound.
 * @method ForwardMessages protect_content(bool $value) Protects the contents of the forwarded messages from forwarding and saving
 */
class ForwardMessages
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private int|string $chat_id;
    private int|string $from_chat_id;
    private string  $message_ids;
    private int $message_thread_id;
    private bool $disable_notification;
    private bool $protect_content;

    public function __construct(Request $request, int|string $chat_id, int|string $from_chat_id, string  $message_ids)
    {
        $this->_request = $request;
        $this->chat_id = $chat_id;
        $this->from_chat_id = $from_chat_id;
        $this->message_ids = $message_ids;
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
        $class = new (static::class)($this->_request, $this->chat_id, $this->from_chat_id, $this->message_ids);
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
