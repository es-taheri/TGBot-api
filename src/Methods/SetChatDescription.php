<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SetChatDescription description(string $value) New chat description, 0-255 characters */
class SetChatDescription
{
    private Request $request;
    private int|string $chat_id;
    private string $description;
    public function __construct(Request $request, int|string $chat_id)
    {
        $this->request = $request;
        $this->chat_id = $chat_id;
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
        $class = new (static::class)($this->request, $this->chat_id);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
