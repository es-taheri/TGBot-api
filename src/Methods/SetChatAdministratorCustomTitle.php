<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;


class SetChatAdministratorCustomTitle
{
    private Request $request;
    private int|string $chat_id;
    private int $user_id;
    private string $custom_title;
    public function __construct(Request $request, int|string $chat_id, int $user_id, string $custom_title)
    {
        $this->request = $request;
        $this->chat_id = $chat_id;
        $this->user_id = $user_id;
        $this->custom_title = $custom_title;
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
        $class = new (static::class)($this->request, $this->chat_id, $this->user_id, $this->custom_title);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
