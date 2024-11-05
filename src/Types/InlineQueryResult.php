<?php

namespace EasyTel\Types;

class InlineQueryResult
{
    public InlineQueryResultCachedAudio $inlinequeryresultcachedaudio;
    public InlineQueryResultCachedDocument $inlinequeryresultcacheddocument;
    public InlineQueryResultCachedGif $inlinequeryresultcachedgif;
    public InlineQueryResultCachedMpeg4Gif $inlinequeryresultcachedmpeg4gif;
    public InlineQueryResultCachedPhoto $inlinequeryresultcachedphoto;
    public InlineQueryResultCachedSticker $inlinequeryresultcachedsticker;
    public InlineQueryResultCachedVideo $inlinequeryresultcachedvideo;
    public InlineQueryResultCachedVoice $inlinequeryresultcachedvoice;
    public InlineQueryResultArticle $inlinequeryresultarticle;
    public InlineQueryResultAudio $inlinequeryresultaudio;
    public InlineQueryResultContact $inlinequeryresultcontact;
    public InlineQueryResultGame $inlinequeryresultgame;
    public InlineQueryResultDocument $inlinequeryresultdocument;
    public InlineQueryResultGif $inlinequeryresultgif;
    public InlineQueryResultLocation $inlinequeryresultlocation;
    public InlineQueryResultMpeg4Gif $inlinequeryresultmpeg4gif;
    public InlineQueryResultPhoto $inlinequeryresultphoto;
    public InlineQueryResultVenue $inlinequeryresultvenue;
    public InlineQueryResultVideo $inlinequeryresultvideo;
    public InlineQueryResultVoice $inlinequeryresultvoice;
    
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
        $this->inlinequeryresultcachedaudio = new InlineQueryResultCachedAudio($update);
        $this->inlinequeryresultcacheddocument = new InlineQueryResultCachedDocument($update);
        $this->inlinequeryresultcachedgif = new InlineQueryResultCachedGif($update);
        $this->inlinequeryresultcachedmpeg4gif = new InlineQueryResultCachedMpeg4Gif($update);
        $this->inlinequeryresultcachedphoto = new InlineQueryResultCachedPhoto($update);
        $this->inlinequeryresultcachedsticker = new InlineQueryResultCachedSticker($update);
        $this->inlinequeryresultcachedvideo = new InlineQueryResultCachedVideo($update);
        $this->inlinequeryresultcachedvoice = new InlineQueryResultCachedVoice($update);
        $this->inlinequeryresultarticle = new InlineQueryResultArticle($update);
        $this->inlinequeryresultaudio = new InlineQueryResultAudio($update);
        $this->inlinequeryresultcontact = new InlineQueryResultContact($update);
        $this->inlinequeryresultgame = new InlineQueryResultGame($update);
        $this->inlinequeryresultdocument = new InlineQueryResultDocument($update);
        $this->inlinequeryresultgif = new InlineQueryResultGif($update);
        $this->inlinequeryresultlocation = new InlineQueryResultLocation($update);
        $this->inlinequeryresultmpeg4gif = new InlineQueryResultMpeg4Gif($update);
        $this->inlinequeryresultphoto = new InlineQueryResultPhoto($update);
        $this->inlinequeryresultvenue = new InlineQueryResultVenue($update);
        $this->inlinequeryresultvideo = new InlineQueryResultVideo($update);
        $this->inlinequeryresultvoice = new InlineQueryResultVoice($update);
    }
}