<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SetMessageReaction reaction(string  $value) A JSON-serialized list of reaction types to set on the message. Currently, as non-premium users, bots can set up to one reaction per message. A custom emoji reaction can be used if it is either already present on the message or explicitly allowed by chat administrators.
 * @method SetMessageReaction is_big(bool $value) Pass <em>True</em> to set the reaction with a big animation */
class SetMessageReaction
{
    private Request $request;
    private int|string $chat_id;
    private int $message_id;
    private string  $reaction;
    private bool $is_big;
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
