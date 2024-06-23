<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SetStickerKeywords keywords(string  $value) A JSON-serialized list of 0-20 search keywords for the sticker with total length of up to 64 characters */
class SetStickerKeywords
{
    private Request $request;
    private string $sticker;
    private string  $keywords;
    public function __construct(Request $request, string $sticker)
    {
        $this->request = $request;
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
        $class = new (static::class)($this->request, $this->sticker);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
