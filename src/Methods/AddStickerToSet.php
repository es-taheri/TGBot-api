<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;


class AddStickerToSet
{
    private Request $request;
    private int $user_id;
    private string $name;
    private string $sticker;
    public function __construct(Request $request, int $user_id, string $name, string $sticker)
    {
        $this->request = $request;
        $this->user_id = $user_id;
        $this->name = $name;
        $this->sticker = $sticker;
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
        $class = new (static::class)($this->request, $this->user_id, $this->name, $this->sticker);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}