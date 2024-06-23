<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SetMyCommands scope(string $value) A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to <a href="https://core.telegram.org/bots/api#botcommandscopedefault">BotCommandScopeDefault</a>.
 * @method SetMyCommands language_code(string $value) A two-letter ISO 639-1 language code. If empty, commands will be applied to all users from the given scope, for whose language there are no dedicated commands */
class SetMyCommands
{
    private Request $request;
    private string  $commands;
    private string $scope;
    private string $language_code;
    public function __construct(Request $request, string  $commands)
    {
        $this->request = $request;
        $this->commands = $commands;
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
        $class = new (static::class)($this->request, $this->commands);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
