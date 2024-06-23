<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SendSticker business_connection_id(string $value) Unique identifier of the business connection on behalf of which the message will be sent
 * @method SendSticker message_thread_id(int $value) Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
 * @method SendSticker emoji(string $value) Emoji associated with the sticker; only for just uploaded stickers
 * @method SendSticker disable_notification(bool $value) Sends the message <a href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a notification with no sound.
 * @method SendSticker protect_content(bool $value) Protects the contents of the sent message from forwarding and saving
 * @method SendSticker message_effect_id(string $value) Unique identifier of the message effect to be added to the message; for private chats only
 * @method SendSticker reply_parameters(string $value) Description of the message to reply to
 * @method SendSticker reply_markup(string $value) Additional interface options. A JSON-serialized object for an <a href="/bots/features#inline-keyboards">inline keyboard</a>, <a href="/bots/features#keyboards">custom reply keyboard</a>, instructions to remove a reply keyboard or to force a reply from the user */
class SendSticker
{
    private Request $request;
    private int|string $chat_id;
    private mixed $sticker;
    private string $business_connection_id;
    private int $message_thread_id;
    private string $emoji;
    private bool $disable_notification;
    private bool $protect_content;
    private string $message_effect_id;
    private string $reply_parameters;
    private string $reply_markup;
    public function __construct(Request $request, int|string $chat_id, mixed $sticker)
    {
        $this->request = $request;
        $this->chat_id = $chat_id;
        $this->sticker = $sticker;
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
        $class = new (static::class)($this->request, $this->chat_id, $this->sticker);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}