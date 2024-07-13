<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SendMediaGroup business_connection_id(string $value) Unique identifier of the business connection on behalf of which the message will be sent
 * @method SendMediaGroup message_thread_id(int $value) Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
 * @method SendMediaGroup disable_notification(bool $value) Sends messages <a href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a notification with no sound.
 * @method SendMediaGroup protect_content(bool $value) Protects the contents of the sent messages from forwarding and saving
 * @method SendMediaGroup message_effect_id(string $value) Unique identifier of the message effect to be added to the message; for private chats only
 * @method SendMediaGroup reply_parameters(string $value) Description of the message to reply to
 */
class SendMediaGroup
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private int|string $chat_id;
    private string  $media;
    private string $business_connection_id;
    private int $message_thread_id;
    private bool $disable_notification;
    private bool $protect_content;
    private string $message_effect_id;
    private string $reply_parameters;
    
    public function __construct(Request $request, int|string $chat_id, string  $media)
    {
        $this->_request = $request;
        $this->chat_id = $chat_id;
        $this->media = $media;
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
        $class = new (static::class)($this->_request, $this->chat_id, $this->media);
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
