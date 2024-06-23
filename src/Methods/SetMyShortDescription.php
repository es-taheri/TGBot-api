<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SetMyShortDescription short_description(string $value) New short description for the bot; 0-120 characters. Pass an empty string to remove the dedicated short description for the given language.
 * @method SetMyShortDescription language_code(string $value) A two-letter ISO 639-1 language code. If empty, the short description will be applied to all users for whose language there is no dedicated short description. */
class SetMyShortDescription
{
    private Request $request;
    private string $short_description;
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
