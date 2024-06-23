<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method CreateNewStickerSet sticker_type(string $value) Type of stickers in the set, pass “regular”, “mask”, or “custom_emoji”. By default, a regular sticker set is created.
 * @method CreateNewStickerSet needs_repainting(bool $value) Pass <em>True</em> if stickers in the sticker set must be repainted to the color of text when used in messages, the accent color if used as emoji status, white on chat photos, or another appropriate color based on context; for custom emoji sticker sets only */
class CreateNewStickerSet
{
    private Request $request;
    private int $user_id;
    private string $name;
    private string $title;
    private string  $stickers;
    private string $sticker_type;
    private bool $needs_repainting;
    public function __construct(Request $request, int $user_id, string $name, string $title, string  $stickers)
    {
        $this->request = $request;
        $this->user_id = $user_id;
        $this->name = $name;
        $this->title = $title;
        $this->stickers = $stickers;
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
        $class = new (static::class)($this->request, $this->user_id, $this->name, $this->title, $this->stickers);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
