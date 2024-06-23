<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method UnbanChatMember only_if_banned(bool $value) Do nothing if the user is not banned */
class UnbanChatMember
{
    private Request $request;
    private int|string $chat_id;
    private int $user_id;
    private bool $only_if_banned;
    public function __construct(Request $request, int|string $chat_id, int $user_id)
    {
        $this->request = $request;
        $this->chat_id = $chat_id;
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
            if (isset($this->{$key}) && $key != 'request') $parameters[$key] = $value;
        endforeach;
        $r = new \ReflectionClass($this);
        return $this->request->send(lcfirst($r->getShortName()), $parameters);
    }

    private function return($function, $value)
    {
        $class = new (static::class)($this->request, $this->chat_id, $this->user_id);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
