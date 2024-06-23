<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;


class UploadStickerFile
{
    private Request $request;
    private int $user_id;
    private mixed $sticker;
    private string $sticker_format;
    public function __construct(Request $request, int $user_id, mixed $sticker, string $sticker_format)
    {
        $this->request = $request;
        $this->user_id = $user_id;
        $this->sticker = $sticker;
        $this->sticker_format = $sticker_format;
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
        $class = new (static::class)($this->request, $this->user_id, $this->sticker, $this->sticker_format);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
