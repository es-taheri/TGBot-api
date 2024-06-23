<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;


class GetCustomEmojiStickers
{
    private Request $request;
    private string  $custom_emoji_ids;
    public function __construct(Request $request, string  $custom_emoji_ids)
    {
        $this->request = $request;
        $this->custom_emoji_ids = $custom_emoji_ids;
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
        $class = new (static::class)($this->request, $this->custom_emoji_ids);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
