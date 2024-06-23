<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SendContact business_connection_id(string $value) Unique identifier of the business connection on behalf of which the message will be sent
 * @method SendContact message_thread_id(int $value) Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
 * @method SendContact last_name(string $value) Contact&#39;s last name
 * @method SendContact vcard(string $value) Additional data about the contact in the form of a <a href="https://en.wikipedia.org/wiki/VCard">vCard</a>, 0-2048 bytes
 * @method SendContact disable_notification(bool $value) Sends the message <a href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a notification with no sound.
 * @method SendContact protect_content(bool $value) Protects the contents of the sent message from forwarding and saving
 * @method SendContact message_effect_id(string $value) Unique identifier of the message effect to be added to the message; for private chats only
 * @method SendContact reply_parameters(string $value) Description of the message to reply to
 * @method SendContact reply_markup(string $value) Additional interface options. A JSON-serialized object for an <a href="/bots/features#inline-keyboards">inline keyboard</a>, <a href="/bots/features#keyboards">custom reply keyboard</a>, instructions to remove a reply keyboard or to force a reply from the user */
class SendContact
{
    private Request $request;
    private int|string $chat_id;
    private string $phone_number;
    private string $first_name;
    private string $business_connection_id;
    private int $message_thread_id;
    private string $last_name;
    private string $vcard;
    private bool $disable_notification;
    private bool $protect_content;
    private string $message_effect_id;
    private string $reply_parameters;
    private string $reply_markup;
    public function __construct(Request $request, int|string $chat_id, string $phone_number, string $first_name)
    {
        $this->request = $request;
        $this->chat_id = $chat_id;
        $this->phone_number = $phone_number;
        $this->first_name = $first_name;
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
        $class = new (static::class)($this->request, $this->chat_id, $this->phone_number, $this->first_name);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
