<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SendPhoto business_connection_id(string $value) Unique identifier of the business connection on behalf of which the message will be sent
 * @method SendPhoto message_thread_id(int $value) Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
 * @method SendPhoto caption(string $value) Photo caption (may also be used when resending photos by <em>file_id</em>), 0-1024 characters after entities parsing
 * @method SendPhoto parse_mode(string $value) Mode for parsing entities in the photo caption. See <a href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
 * @method SendPhoto caption_entities(string  $value) A JSON-serialized list of special entities that appear in the caption, which can be specified instead of <em>parse_mode</em>
 * @method SendPhoto show_caption_above_media(bool $value) Pass <em>True</em>, if the caption must be shown above the message media
 * @method SendPhoto has_spoiler(bool $value) Pass <em>True</em> if the photo needs to be covered with a spoiler animation
 * @method SendPhoto disable_notification(bool $value) Sends the message <a href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a notification with no sound.
 * @method SendPhoto protect_content(bool $value) Protects the contents of the sent message from forwarding and saving
 * @method SendPhoto message_effect_id(string $value) Unique identifier of the message effect to be added to the message; for private chats only
 * @method SendPhoto reply_parameters(string $value) Description of the message to reply to
 * @method SendPhoto reply_markup(string $value) Additional interface options. A JSON-serialized object for an <a href="/bots/features#inline-keyboards">inline keyboard</a>, <a href="/bots/features#keyboards">custom reply keyboard</a>, instructions to remove a reply keyboard or to force a reply from the user */
class SendPhoto
{
    private Request $request;
    private int|string $chat_id;
    private mixed $photo;
    private string $business_connection_id;
    private int $message_thread_id;
    private string $caption;
    private string $parse_mode;
    private string  $caption_entities;
    private bool $show_caption_above_media;
    private bool $has_spoiler;
    private bool $disable_notification;
    private bool $protect_content;
    private string $message_effect_id;
    private string $reply_parameters;
    private string $reply_markup;
    public function __construct(Request $request, int|string $chat_id, mixed $photo)
    {
        $this->request = $request;
        $this->chat_id = $chat_id;
        $this->photo = $photo;
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
        $class = new (static::class)($this->request, $this->chat_id, $this->photo);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
