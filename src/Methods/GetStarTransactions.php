<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method GetStarTransactions offset(int $value) Number of transactions to skip in the response
 * @method GetStarTransactions limit(int $value) The maximum number of transactions to be retrieved. Values between 1-100 are accepted. Defaults to 100.
 */
class GetStarTransactions
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private int $offset;
    private int $limit;

    public function __construct(Request $request)
    {
        $this->_request = $request;
        
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
        $class = new (static::class)($this->_request);
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
