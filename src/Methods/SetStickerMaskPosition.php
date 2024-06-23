<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SetStickerMaskPosition mask_position(string $value) A JSON-serialized object with the position where the mask should be placed on faces. Omit the parameter to remove the mask position. */
class SetStickerMaskPosition
{
    private Request $request;
    private string $sticker;
    private string $mask_position;
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
