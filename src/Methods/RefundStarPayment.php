<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;


class RefundStarPayment
{
    private Request $request;
    private int $user_id;
    private string $telegram_payment_charge_id;
    public function __construct(Request $request, int $user_id, string $telegram_payment_charge_id)
    {
        $this->request = $request;
        $this->user_id = $user_id;
        $this->telegram_payment_charge_id = $telegram_payment_charge_id;
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
        $class = new (static::class)($this->request, $this->user_id, $this->telegram_payment_charge_id);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
