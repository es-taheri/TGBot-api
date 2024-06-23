<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SendLocation business_connection_id(string $value) Unique identifier of the business connection on behalf of which the message will be sent
 * @method SendLocation message_thread_id(int $value) Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
 * @method SendLocation horizontal_accuracy(Float $value) The radius of uncertainty for the location, measured in meters; 0-1500
 * @method SendLocation live_period(int $value) Period in seconds during which the location will be updated (see <a href="https://telegram.org/blog/live-locations">Live Locations</a>, should be between 60 and 86400, or 0x7FFFFFFF for live locations that can be edited indefinitely.
 * @method SendLocation heading(int $value) For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if specified.
 * @method SendLocation proximity_alert_radius(int $value) For live locations, a maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified.
 * @method SendLocation disable_notification(bool $value) Sends the message <a href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a notification with no sound.
 * @method SendLocation protect_content(bool $value) Protects the contents of the sent message from forwarding and saving
 * @method SendLocation message_effect_id(string $value) Unique identifier of the message effect to be added to the message; for private chats only
 * @method SendLocation reply_parameters(string $value) Description of the message to reply to
 * @method SendLocation reply_markup(string $value) Additional interface options. A JSON-serialized object for an <a href="/bots/features#inline-keyboards">inline keyboard</a>, <a href="/bots/features#keyboards">custom reply keyboard</a>, instructions to remove a reply keyboard or to force a reply from the user */
class SendLocation
{
    private Request $request;
    private int|string $chat_id;
    private Float $latitude;
    private Float $longitude;
    private string $business_connection_id;
    private int $message_thread_id;
    private Float $horizontal_accuracy;
    private int $live_period;
    private int $heading;
    private int $proximity_alert_radius;
    private bool $disable_notification;
    private bool $protect_content;
    private string $message_effect_id;
    private string $reply_parameters;
    private string $reply_markup;
    public function __construct(Request $request, int|string $chat_id, Float $latitude, Float $longitude)
    {
        $this->request = $request;
        $this->chat_id = $chat_id;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
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
        $class = new (static::class)($this->request, $this->chat_id, $this->latitude, $this->longitude);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
