<?php

namespace EasyTel\Types;

class InputMedia
{
    public InputMediaAnimation $inputmediaanimation;
    public InputMediaDocument $inputmediadocument;
    public InputMediaAudio $inputmediaaudio;
    public InputMediaPhoto $inputmediaphoto;
    public InputMediaVideo $inputmediavideo;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        $r = new \ReflectionClass(static::class);
        foreach ($objects as $object):
            if ($r->hasProperty($object)):
                $prop = $r->getProperty($object);
                $type = $prop->getType();
                if (in_array($type, ['mixed', 'True', 'string', 'bool', 'int', 'float', 'array'])) $this->{$object} = $update[$object];
            endif;
        endforeach;
        $this->inputmediaanimation = new InputMediaAnimation($update);
        $this->inputmediadocument = new InputMediaDocument($update);
        $this->inputmediaaudio = new InputMediaAudio($update);
        $this->inputmediaphoto = new InputMediaPhoto($update);
        $this->inputmediavideo = new InputMediaVideo($update);
    }
}