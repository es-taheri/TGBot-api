<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SendVenue business_connection_id(string $value) Unique identifier of the business connection on behalf of which the message will be sent
 * @method SendVenue message_thread_id(int $value) Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
 * @method SendVenue foursquare_id(string $value) Foursquare identifier of the venue
 * @method SendVenue foursquare_type(string $value) Foursquare type of the venue, if known. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
 * @method SendVenue google_place_id(string $value) Google Places identifier of the venue
 * @method SendVenue google_place_type(string $value) Google Places type of the venue. (See <a href="https://developers.google.com/places/web-service/supported_types">supported types</a>.)
 * @method SendVenue disable_notification(bool $value) Sends the message <a href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a notification with no sound.
 * @method SendVenue protect_content(bool $value) Protects the contents of the sent message from forwarding and saving
 * @method SendVenue allow_paid_broadcast(bool $value) Pass <em>True</em> to allow up to 1000 messages per second, ignoring <a href="https://core.telegram.org/bots/faq#how-can-i-message-all-of-my-bot-39s-subscribers-at-once">broadcasting limits</a> for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot&#39;s balance
 * @method SendVenue message_effect_id(string $value) Unique identifier of the message effect to be added to the message; for private chats only
 * @method SendVenue reply_parameters(string $value) Description of the message to reply to
 * @method SendVenue reply_markup(string $value) Additional interface options. A JSON-serialized object for an <a href="/bots/features#inline-keyboards">inline keyboard</a>, <a href="/bots/features#keyboards">custom reply keyboard</a>, instructions to remove a reply keyboard or to force a reply from the user
 */
class SendVenue
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private int|string $chat_id;
    private Float $latitude;
    private Float $longitude;
    private string $title;
    private string $address;
    private string $business_connection_id;
    private int $message_thread_id;
    private string $foursquare_id;
    private string $foursquare_type;
    private string $google_place_id;
    private string $google_place_type;
    private bool $disable_notification;
    private bool $protect_content;
    private bool $allow_paid_broadcast;
    private string $message_effect_id;
    private string $reply_parameters;
    private string $reply_markup;

    public function __construct(Request $request, int|string $chat_id, Float $latitude, Float $longitude, string $title, string $address)
    {
        $this->_request = $request;
        $this->chat_id = $chat_id;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->title = $title;
        $this->address = $address;
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
        $class = new (static::class)($this->_request, $this->chat_id, $this->latitude, $this->longitude, $this->title, $this->address);
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
