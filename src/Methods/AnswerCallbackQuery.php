<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method AnswerCallbackQuery text(string $value) Text of the notification. If not specified, nothing will be shown to the user, 0-200 characters
 * @method AnswerCallbackQuery show_alert(bool $value) If <em>True</em>, an alert will be shown by the client instead of a notification at the top of the chat screen. Defaults to <em>false</em>.
 * @method AnswerCallbackQuery url(string $value) URL that will be opened by the user&#39;s client. If you have created a <a href="https://core.telegram.org/bots/api#game">Game</a> and accepted the conditions via <a href="https://t.me/botfather">@BotFather</a>, specify the URL that opens your game - note that this will only work if the query comes from a <a href="https://core.telegram.org/bots/api#inlinekeyboardbutton"><em>callback_game</em></a> button.<br><br>Otherwise, you may use links like <code>t.me/your_bot?start=XXXX</code> that open your bot with a parameter.
 * @method AnswerCallbackQuery cache_time(int $value) The maximum amount of time in seconds that the result of the callback query may be cached client-side. Telegram apps will support caching starting in version 3.14. Defaults to 0.
 */
class AnswerCallbackQuery
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private string $callback_query_id;
    private string $text;
    private bool $show_alert;
    private string $url;
    private int $cache_time;

    public function __construct(Request $request, string $callback_query_id)
    {
        $this->_request = $request;
        $this->callback_query_id = $callback_query_id;
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
        $class = new (static::class)($this->_request, $this->callback_query_id);
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
