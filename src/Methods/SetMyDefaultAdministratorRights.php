<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SetMyDefaultAdministratorRights rights(string $value) A JSON-serialized object describing new default administrator rights. If not specified, the default administrator rights will be cleared.
 * @method SetMyDefaultAdministratorRights for_channels(bool $value) Pass <em>True</em> to change the default administrator rights of the bot in channels. Otherwise, the default administrator rights of the bot for groups and supergroups will be changed. */
class SetMyDefaultAdministratorRights
{
    private Request $request;
    private string $rights;
    private bool $for_channels;
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
