<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SetCustomEmojiStickerSetThumbnail custom_emoji_id(string $value) Custom emoji identifier of a sticker from the sticker set; pass an empty string to drop the thumbnail and use the first sticker as the thumbnail. */
class SetCustomEmojiStickerSetThumbnail
{
    private Request $request;
    private string $name;
    private string $custom_emoji_id;
    public function __construct(Request $request, string $name)
    {
        $this->request = $request;
        $this->name = $name;
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
        $class = new (static::class)($this->request, $this->name);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
