<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;


class SetStickerSetTitle
{
    private Request $request;
    private string $name;
    private string $title;
    public function __construct(Request $request, string $name, string $title)
    {
        $this->request = $request;
        $this->name = $name;
        $this->title = $title;
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
        $class = new (static::class)($this->request, $this->name, $this->title);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
