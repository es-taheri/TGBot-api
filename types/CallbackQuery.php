<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class CallbackQuery
{
    public string $id;
    public User $from;
    public Message $message;
    public string $inline_message_id;
    public string $chat_instance;
    public string $data;
    public string $game_short_name;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['from'])) $this->from = new User($update['from']);
        if (isset($update['message'])) $this->message = new Message($update['message']);
    }
}