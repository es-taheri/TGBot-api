<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;


class SetStickerPositionInSet
{
    private Request $request;
    private string $sticker;
    private int $position;
    public function __construct(Request $request, string $sticker, int $position)
    {
        $this->request = $request;
        $this->sticker = $sticker;
        $this->position = $position;
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
        $class = new (static::class)($this->request, $this->sticker, $this->position);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
