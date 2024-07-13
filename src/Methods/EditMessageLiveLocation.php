<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method EditMessageLiveLocation chat_id(int|string $value) Required if <em>inline_message_id</em> is not specified. Unique identifier for the target chat or username of the target channel (in the format <code>@channelusername</code>)
 * @method EditMessageLiveLocation message_id(int $value) Required if <em>inline_message_id</em> is not specified. Identifier of the message to edit
 * @method EditMessageLiveLocation inline_message_id(string $value) Required if <em>chat_id</em> and <em>message_id</em> are not specified. Identifier of the inline message
 * @method EditMessageLiveLocation live_period(int $value) New period in seconds during which the location can be updated, starting from the message send date. If 0x7FFFFFFF is specified, then the location can be updated forever. Otherwise, the new value must not exceed the current <em>live_period</em> by more than a day, and the live location expiration date must remain within the next 90 days. If not specified, then <em>live_period</em> remains unchanged
 * @method EditMessageLiveLocation horizontal_accuracy(Float $value) The radius of uncertainty for the location, measured in meters; 0-1500
 * @method EditMessageLiveLocation heading(int $value) Direction in which the user is moving, in degrees. Must be between 1 and 360 if specified.
 * @method EditMessageLiveLocation proximity_alert_radius(int $value) The maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified.
 * @method EditMessageLiveLocation reply_markup(string $value) A JSON-serialized object for a new <a href="/bots/features#inline-keyboards">inline keyboard</a>.
 */
class EditMessageLiveLocation
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private Float $latitude;
    private Float $longitude;
    private int|string $chat_id;
    private int $message_id;
    private string $inline_message_id;
    private int $live_period;
    private Float $horizontal_accuracy;
    private int $heading;
    private int $proximity_alert_radius;
    private string $reply_markup;
    
    public function __construct(Request $request, Float $latitude, Float $longitude)
    {
        $this->_request = $request;
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
            if (isset($this->{$key}) && !in_array($key, ['_request', '_sent', '_returned'])) $parameters[$key] = $value;
        endforeach;
        $r = new \ReflectionClass($this);
        $this->_sent = true;
        return $this->_request->send(lcfirst($r->getShortName()), $parameters);
    }

    private function return($function, $value)
    {
        $class = new (static::class)($this->_request, $this->latitude, $this->longitude);
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
