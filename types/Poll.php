<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class Poll
{
    public string $id;
    public string $question;
    public Json|string  $options;
    public int $total_voter_count;
    public bool $is_closed;
    public bool $is_anonymous;
    public string $type;
    public bool $allows_multiple_answers;
    public int $correct_option_id;
    public string $explanation;
    public Json|string  $explanation_entities;
    public int $open_period;
    public int $close_date;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $this->{$object} = $update[$object];
        endforeach;
        
    }
}