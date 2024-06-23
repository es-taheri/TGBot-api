<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method AnswerShippingQuery shipping_options(string  $value) Required if <em>ok</em> is <em>True</em>. A JSON-serialized array of available shipping options.
 * @method AnswerShippingQuery error_message(string $value) Required if <em>ok</em> is <em>False</em>. Error message in human readable form that explains why it is impossible to complete the order (e.g. &quot;Sorry, delivery to your desired address is unavailable&#39;). Telegram will display this message to the user. */
class AnswerShippingQuery
{
    private Request $request;
    private string $shipping_query_id;
    private bool $ok;
    private string  $shipping_options;
    private string $error_message;
    public function __construct(Request $request, string $shipping_query_id, bool $ok)
    {
        $this->request = $request;
        $this->shipping_query_id = $shipping_query_id;
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
            if (isset($this->{$key}) && $key != 'request') $parameters[$key] = $value;
        endforeach;
        $r = new \ReflectionClass($this);
        return $this->request->send(lcfirst($r->getShortName()), $parameters);
    }

    private function return($function, $value)
    {
        $class = new (static::class)($this->request, $this->shipping_query_id, $this->ok);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
