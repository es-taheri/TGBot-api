<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method CreateForumTopic icon_color(int $value) Color of the topic icon in RGB format. Currently, must be one of 7322096 (0x6FB9F0), 16766590 (0xFFD67E), 13338331 (0xCB86DB), 9367192 (0x8EEE98), 16749490 (0xFF93B2), or 16478047 (0xFB6F5F)
 * @method CreateForumTopic icon_custom_emoji_id(string $value) Unique identifier of the custom emoji shown as the topic icon. Use <a href="https://core.telegram.org/bots/api#getforumtopiciconstickers">getForumTopicIconStickers</a> to get all allowed custom emoji identifiers. */
class CreateForumTopic
{
    private Request $request;
    private int|string $chat_id;
    private string $name;
    private int $icon_color;
    private string $icon_custom_emoji_id;
    public function __construct(Request $request, int|string $chat_id, string $name)
    {
        $this->request = $request;
        $this->chat_id = $chat_id;
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
        $class = new (static::class)($this->request, $this->chat_id, $this->name);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
