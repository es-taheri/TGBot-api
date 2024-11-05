<?php

namespace EasyTel\Types;

class InputMessageContent
{
    public InputTextMessageContent $inputtextmessagecontent;
    public InputLocationMessageContent $inputlocationmessagecontent;
    public InputVenueMessageContent $inputvenuemessagecontent;
    public InputContactMessageContent $inputcontactmessagecontent;
    public InputInvoiceMessageContent $inputinvoicemessagecontent;
    
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
        $this->inputtextmessagecontent = new InputTextMessageContent($update);
        $this->inputlocationmessagecontent = new InputLocationMessageContent($update);
        $this->inputvenuemessagecontent = new InputVenueMessageContent($update);
        $this->inputcontactmessagecontent = new InputContactMessageContent($update);
        $this->inputinvoicemessagecontent = new InputInvoiceMessageContent($update);
    }
}