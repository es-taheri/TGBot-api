<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SetCustomEmojiStickerSetThumbnail custom_emoji_id(string $value) Custom emoji identifier of a sticker from the sticker set; pass an empty string to drop the thumbnail and use the first sticker as the thumbnail.
 */
class SetCustomEmojiStickerSetThumbnail
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private string $name;
    private string $custom_emoji_id;

    public function __construct(Request $request, string $name)
    {
        $this->_request = $request;
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
            if (isset($this->{$key}) && !in_array($key, ['_request', '_sent', '_returned'])) $parameters[$key] = $value;
        endforeach;
        $r = new \ReflectionClass($this);
        $this->_sent = true;
        return $this->_request->send(lcfirst($r->getShortName()), $parameters);
    }

    private function return($function, $value)
    {
        $class = new (static::class)($this->_request, $this->name);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            if (!in_array($key, ['_sent', '_returned'])) $class->{$key} = $value;
        endforeach;
        $this->_returned = true;
        return $class;
    }

    public function __destruct()
    {
        if (!$this->_returned && !$this->_sent) $this->_send();
    }
}
