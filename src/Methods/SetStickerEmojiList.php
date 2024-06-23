<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;


class SetStickerEmojiList
{
    private Request $request;
    private string $sticker;
    private string  $emoji_list;
    public function __construct(Request $request, string $sticker, string  $emoji_list)
    {
        $this->request = $request;
        $this->sticker = $sticker;
        $this->emoji_list = $emoji_list;
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
        $class = new (static::class)($this->request, $this->sticker, $this->emoji_list);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
