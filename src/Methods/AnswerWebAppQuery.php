<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;


class AnswerWebAppQuery
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private string $web_app_query_id;
    private string $result;

    public function __construct(Request $request, string $web_app_query_id, string $result)
    {
        $this->_request = $request;
        $this->web_app_query_id = $web_app_query_id;
        $this->result = $result;
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
        $class = new (static::class)($this->_request, $this->web_app_query_id, $this->result);
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
