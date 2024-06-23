<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;


class AnswerWebAppQuery
{
    private Request $request;
    private string $web_app_query_id;
    private string $result;
    public function __construct(Request $request, string $web_app_query_id, string $result)
    {
        $this->request = $request;
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
            if (isset($this->{$key}) && $key != 'request') $parameters[$key] = $value;
        endforeach;
        $r = new \ReflectionClass($this);
        return $this->request->send(lcfirst($r->getShortName()), $parameters);
    }

    private function return($function, $value)
    {
        $class = new (static::class)($this->request, $this->web_app_query_id, $this->result);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
