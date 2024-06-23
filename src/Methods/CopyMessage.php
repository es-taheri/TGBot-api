<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method CopyMessage message_thread_id(int $value) Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
 * @method CopyMessage caption(string $value) New caption for media, 0-1024 characters after entities parsing. If not specified, the original caption is kept
 * @method CopyMessage parse_mode(string $value) Mode for parsing entities in the new caption. See <a href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
 * @method CopyMessage caption_entities(string  $value) A JSON-serialized list of special entities that appear in the new caption, which can be specified instead of <em>parse_mode</em>
 * @method CopyMessage show_caption_above_media(bool $value) Pass <em>True</em>, if the caption must be shown above the message media. Ignored if a new caption isn&#39;t specified.
 * @method CopyMessage disable_notification(bool $value) Sends the message <a href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a notification with no sound.
 * @method CopyMessage protect_content(bool $value) Protects the contents of the sent message from forwarding and saving
 * @method CopyMessage reply_parameters(string $value) Description of the message to reply to
 * @method CopyMessage reply_markup(string $value) Additional interface options. A JSON-serialized object for an <a href="/bots/features#inline-keyboards">inline keyboard</a>, <a href="/bots/features#keyboards">custom reply keyboard</a>, instructions to remove a reply keyboard or to force a reply from the user */
class CopyMessage
{
    private Request $request;
    private int|string $chat_id;
    private int|string $from_chat_id;
    private int $message_id;
    private int $message_thread_id;
    private string $caption;
    private string $parse_mode;
    private string  $caption_entities;
    private bool $show_caption_above_media;
    private bool $disable_notification;
    private bool $protect_content;
    private string $reply_parameters;
    private string $reply_markup;
    public function __construct(Request $request, int|string $chat_id, int|string $from_chat_id, int $message_id)
    {
        $this->request = $request;
        $this->chat_id = $chat_id;
        $this->from_chat_id = $from_chat_id;
        $this->message_id = $message_id;
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
        $class = new (static::class)($this->request, $this->chat_id, $this->from_chat_id, $this->message_id);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}