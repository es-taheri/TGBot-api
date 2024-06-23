<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SetStickerSetThumbnail thumbnail(mixed $value) A <strong>.WEBP</strong> or <strong>.PNG</strong> image with the thumbnail, must be up to 128 kilobytes in size and have a width and height of exactly 100px, or a <strong>.TGS</strong> animation with a thumbnail up to 32 kilobytes in size (see <a href="/stickers#animated-sticker-requirements"><a href="https://core.telegram.org/stickers#animated-sticker-requirements">https://core.telegram.org/stickers#animated-sticker-requirements</a></a> for animated sticker technical requirements), or a <strong>WEBM</strong> video with the thumbnail up to 32 kilobytes in size; see <a href="/stickers#video-sticker-requirements"><a href="https://core.telegram.org/stickers#video-sticker-requirements">https://core.telegram.org/stickers#video-sticker-requirements</a></a> for video sticker technical requirements. Pass a <em>file_id</em> as a String to send a file that already exists on the Telegram servers, pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. <a href="https://core.telegram.org/bots/api#sending-files">More information on Sending Files »</a>. Animated and video sticker set thumbnails can&#39;t be uploaded via HTTP URL. If omitted, then the thumbnail is dropped and the first sticker is used as the thumbnail. */
class SetStickerSetThumbnail
{
    private Request $request;
    private string $name;
    private int $user_id;
    private string $format;
    private mixed $thumbnail;
    public function __construct(Request $request, string $name, int $user_id, string $format)
    {
        $this->request = $request;
        $this->name = $name;
        $this->user_id = $user_id;
        $this->format = $format;
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
        $class = new (static::class)($this->request, $this->name, $this->user_id, $this->format);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
