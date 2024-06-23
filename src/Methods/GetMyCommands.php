<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method GetMyCommands scope(string $value) A JSON-serialized object, describing scope of users. Defaults to <a href="https://core.telegram.org/bots/api#botcommandscopedefault">BotCommandScopeDefault</a>.
 * @method GetMyCommands language_code(string $value) A two-letter ISO 639-1 language code or an empty string */
class GetMyCommands
{
    private Request $request;
    private string $scope;
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
