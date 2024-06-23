<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method GetUserProfilePhotos offset(int $value) Sequential number of the first photo to be returned. By default, all photos are returned.
 * @method GetUserProfilePhotos limit(int $value) Limits the number of photos to be retrieved. Values between 1-100 are accepted. Defaults to 100. */
class GetUserProfilePhotos
{
    private Request $request;
    private int $user_id;
    private int $offset;
    private int $limit;
    public function __construct(Request $request, int $user_id)
    {
        $this->request = $request;
        $this->user_id = $user_id;
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
        $class = new (static::class)($this->request, $this->user_id);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
