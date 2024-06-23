<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SendGame business_connection_id(string $value) Unique identifier of the business connection on behalf of which the message will be sent
 * @method SendGame message_thread_id(int $value) Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
 * @method SendGame disable_notification(bool $value) Sends the message <a href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a notification with no sound.
 * @method SendGame protect_content(bool $value) Protects the contents of the sent message from forwarding and saving
 * @method SendGame message_effect_id(string $value) Unique identifier of the message effect to be added to the message; for private chats only
 * @method SendGame reply_parameters(string $value) Description of the message to reply to
 * @method SendGame reply_markup(string $value) A JSON-serialized object for an <a href="/bots/features#inline-keyboards">inline keyboard</a>. If empty, one &#39;Play game_title&#39; button will be shown. If not empty, the first button must launch the game. */
class SendGame
{
    private Request $request;
    private int $chat_id;
    private string $game_short_name;
    private string $business_connection_id;
    private int $message_thread_id;
    private bool $disable_notification;
    private bool $protect_content;
    private string $message_effect_id;
    private string $reply_parameters;
    private string $reply_markup;
    public function __construct(Request $request, int $chat_id, string $game_short_name)
    {
        $this->request = $request;
        $this->chat_id = $chat_id;
        $this->game_short_name = $game_short_name;
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
        $class = new (static::class)($this->request, $this->chat_id, $this->game_short_name);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
