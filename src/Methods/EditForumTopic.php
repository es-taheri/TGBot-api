<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method EditForumTopic name(string $value) New topic name, 0-128 characters. If not specified or empty, the current name of the topic will be kept
 * @method EditForumTopic icon_custom_emoji_id(string $value) New unique identifier of the custom emoji shown as the topic icon. Use <a href="https://core.telegram.org/bots/api#getforumtopiciconstickers">getForumTopicIconStickers</a> to get all allowed custom emoji identifiers. Pass an empty string to remove the icon. If not specified, the current icon will be kept */
class EditForumTopic
{
    private Request $request;
    private int|string $chat_id;
    private int $message_thread_id;
    private string $name;
    private string $icon_custom_emoji_id;
    public function __construct(Request $request, int|string $chat_id, int $message_thread_id)
    {
        $this->request = $request;
        $this->chat_id = $chat_id;
        $this->message_thread_id = $message_thread_id;
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
        $class = new (static::class)($this->request, $this->chat_id, $this->message_thread_id);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
