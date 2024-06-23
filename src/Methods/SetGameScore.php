<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SetGameScore force(bool $value) Pass <em>True</em> if the high score is allowed to decrease. This can be useful when fixing mistakes or banning cheaters
 * @method SetGameScore disable_edit_message(bool $value) Pass <em>True</em> if the game message should not be automatically edited to include the current scoreboard
 * @method SetGameScore chat_id(int $value) Required if <em>inline_message_id</em> is not specified. Unique identifier for the target chat
 * @method SetGameScore message_id(int $value) Required if <em>inline_message_id</em> is not specified. Identifier of the sent message
 * @method SetGameScore inline_message_id(string $value) Required if <em>chat_id</em> and <em>message_id</em> are not specified. Identifier of the inline message */
class SetGameScore
{
    private Request $request;
    private int $user_id;
    private int $score;
    private bool $force;
    private bool $disable_edit_message;
    private int $chat_id;
    private int $message_id;
    private string $inline_message_id;
    public function __construct(Request $request, int $user_id, int $score)
    {
        $this->request = $request;
        $this->user_id = $user_id;
        $this->score = $score;
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
        $class = new (static::class)($this->request, $this->user_id, $this->score);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            $class->{$key} = $value;
        endforeach;
        return $class;
    }
}
