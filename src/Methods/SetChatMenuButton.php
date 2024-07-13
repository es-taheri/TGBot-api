<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SetChatMenuButton chat_id(int $value) Unique identifier for the target private chat. If not specified, default bot&#39;s menu button will be changed
 * @method SetChatMenuButton menu_button(string $value) A JSON-serialized object for the bot&#39;s new menu button. Defaults to <a href="https://core.telegram.org/bots/api#menubuttondefault">MenuButtonDefault</a>
 */
class SetChatMenuButton
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private int $chat_id;
    private string $menu_button;
    
    public function __construct(Request $request)
    {
        $this->_request = $request;
        
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
        $class = new (static::class)($this->_request);
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
