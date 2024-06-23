<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method StopPoll reply_markup(string $value) A JSON-serialized object for a new message <a href="/bots/features#inline-keyboards">inline keyboard</a>. */
class StopPoll
{
    private Request $request;
    private int|string $chat_id;
    private int $message_id;
    private string $reply_markup;
    public function __construct(Request $request, int|string $chat_id, int $message_id)
    {
        $this->request = $request;
        $this->chat_id = $chat_id;
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
        $class = new (static::class)($this->request, $this->chat_id, $this->message_id);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
