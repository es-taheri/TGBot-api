<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SetChatMenuButton chat_id(int $value) Unique identifier for the target private chat. If not specified, default bot&#39;s menu button will be changed
 * @method SetChatMenuButton menu_button(string $value) A JSON-serialized object for the bot&#39;s new menu button. Defaults to <a href="https://core.telegram.org/bots/api#menubuttondefault">MenuButtonDefault</a> */
class SetChatMenuButton
{
    private Request $request;
    private int $chat_id;
    private string $menu_button;
    public function __construct(Request $request)
    {
        $this->request = $request;
        
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
        $class = new (static::class)($this->request);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
