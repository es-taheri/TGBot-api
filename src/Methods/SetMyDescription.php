<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SetMyDescription description(string $value) New bot description; 0-512 characters. Pass an empty string to remove the dedicated description for the given language.
 * @method SetMyDescription language_code(string $value) A two-letter ISO 639-1 language code. If empty, the description will be applied to all users for whose language there is no dedicated description. */
class SetMyDescription
{
    private Request $request;
    private string $description;
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
