<?php

namespace EasyTel\Types;

class PassportElementError
{
    public PassportElementErrorDataField $passportelementerrordatafield;
    public PassportElementErrorFrontSide $passportelementerrorfrontside;
    public PassportElementErrorReverseSide $passportelementerrorreverseside;
    public PassportElementErrorSelfie $passportelementerrorselfie;
    public PassportElementErrorFile $passportelementerrorfile;
    public PassportElementErrorFiles $passportelementerrorfiles;
    public PassportElementErrorTranslationFile $passportelementerrortranslationfile;
    public PassportElementErrorTranslationFiles $passportelementerrortranslationfiles;
    public PassportElementErrorUnspecified $passportelementerrorunspecified;
    
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
        $this->passportelementerrordatafield = new PassportElementErrorDataField($update);
        $this->passportelementerrorfrontside = new PassportElementErrorFrontSide($update);
        $this->passportelementerrorreverseside = new PassportElementErrorReverseSide($update);
        $this->passportelementerrorselfie = new PassportElementErrorSelfie($update);
        $this->passportelementerrorfile = new PassportElementErrorFile($update);
        $this->passportelementerrorfiles = new PassportElementErrorFiles($update);
        $this->passportelementerrortranslationfile = new PassportElementErrorTranslationFile($update);
        $this->passportelementerrortranslationfiles = new PassportElementErrorTranslationFiles($update);
        $this->passportelementerrorunspecified = new PassportElementErrorUnspecified($update);
    }
}