<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method GetGameHighScores chat_id(int $value) Required if <em>inline_message_id</em> is not specified. Unique identifier for the target chat
 * @method GetGameHighScores message_id(int $value) Required if <em>inline_message_id</em> is not specified. Identifier of the sent message
 * @method GetGameHighScores inline_message_id(string $value) Required if <em>chat_id</em> and <em>message_id</em> are not specified. Identifier of the inline message
 */
class GetGameHighScores
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private int $user_id;
    private int $chat_id;
    private int $message_id;
    private string $inline_message_id;

    public function __construct(Request $request, int $user_id)
    {
        $this->_request = $request;
        $this->user_id = $user_id;
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
        $class = new (static::class)($this->_request, $this->user_id);
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
