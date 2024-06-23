<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method GetMyName language_code(string $value) A two-letter ISO 639-1 language code or an empty string */
class GetMyName
{
    private Request $request;
    private string $language_code;
    public function __construct(Request $request)
    {
        $this->request = $request;
        
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
        $class = new (static::class)($this->request);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
