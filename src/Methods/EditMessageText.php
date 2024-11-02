<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method EditMessageText business_connection_id(string $value) Unique identifier of the business connection on behalf of which the message to be edited was sent
 * @method EditMessageText chat_id(int|string $value) Required if <em>inline_message_id</em> is not specified. Unique identifier for the target chat or username of the target channel (in the format <code>@channelusername</code>)
 * @method EditMessageText message_id(int $value) Required if <em>inline_message_id</em> is not specified. Identifier of the message to edit
 * @method EditMessageText inline_message_id(string $value) Required if <em>chat_id</em> and <em>message_id</em> are not specified. Identifier of the inline message
 * @method EditMessageText parse_mode(string $value) Mode for parsing entities in the message text. See <a href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
 * @method EditMessageText entities(string  $value) A JSON-serialized list of special entities that appear in message text, which can be specified instead of <em>parse_mode</em>
 * @method EditMessageText link_preview_options(string $value) Link preview generation options for the message
 * @method EditMessageText reply_markup(string $value) A JSON-serialized object for an <a href="/bots/features#inline-keyboards">inline keyboard</a>.
 */
class EditMessageText
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private string $text;
    private string $business_connection_id;
    private int|string $chat_id;
    private int $message_id;
    private string $inline_message_id;
    private string $parse_mode;
    private string  $entities;
    private string $link_preview_options;
    private string $reply_markup;

    public function __construct(Request $request, string $text)
    {
        $this->_request = $request;
        $this->text = $text;
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
        $class = new (static::class)($this->_request, $this->text);
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
