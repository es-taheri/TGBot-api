<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method AnswerInlineQuery cache_time(int $value) The maximum amount of time in seconds that the result of the inline query may be cached on the server. Defaults to 300.
 * @method AnswerInlineQuery is_personal(bool $value) Pass <em>True</em> if results may be cached on the server side only for the user that sent the query. By default, results may be returned to any user who sends the same query.
 * @method AnswerInlineQuery next_offset(string $value) Pass the offset that a client should send in the next query with the same text to receive more results. Pass an empty string if there are no more results or if you don&#39;t support pagination. Offset length can&#39;t exceed 64 bytes.
 * @method AnswerInlineQuery button(string $value) A JSON-serialized object describing a button to be shown above inline query results */
class AnswerInlineQuery
{
    private Request $request;
    private string $inline_query_id;
    private string  $results;
    private int $cache_time;
    private bool $is_personal;
    private string $next_offset;
    private string $button;
    public function __construct(Request $request, string $inline_query_id, string  $results)
    {
        $this->request = $request;
        $this->inline_query_id = $inline_query_id;
        $this->results = $results;
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
        $class = new (static::class)($this->request, $this->inline_query_id, $this->results);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
