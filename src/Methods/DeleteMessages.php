<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;


class DeleteMessages
{
    private Request $request;
    private int|string $chat_id;
    private string  $message_ids;
    public function __construct(Request $request, int|string $chat_id, string  $message_ids)
    {
        $this->request = $request;
        $this->chat_id = $chat_id;
        $this->message_ids = $message_ids;
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
        $class = new (static::class)($this->request, $this->chat_id, $this->message_ids);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
