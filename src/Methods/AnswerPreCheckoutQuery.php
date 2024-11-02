<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method AnswerPreCheckoutQuery error_message(string $value) Required if <em>ok</em> is <em>False</em>. Error message in human readable form that explains the reason for failure to proceed with the checkout (e.g. &quot;Sorry, somebody just bought the last of our amazing black T-shirts while you were busy filling out your payment details. Please choose a different color or garment!&quot;). Telegram will display this message to the user.
 */
class AnswerPreCheckoutQuery
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private string $pre_checkout_query_id;
    private bool $ok;
    private string $error_message;

    public function __construct(Request $request, string $pre_checkout_query_id, bool $ok)
    {
        $this->_request = $request;
        $this->pre_checkout_query_id = $pre_checkout_query_id;
        $this->ok = $ok;
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
        $class = new (static::class)($this->_request, $this->pre_checkout_query_id, $this->ok);
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
