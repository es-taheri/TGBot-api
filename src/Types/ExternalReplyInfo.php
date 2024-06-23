<?php

namespace EasyTel\Types;

class ExternalReplyInfo
{
    public MessageOrigin $origin;
    public Chat $chat;
    public int $message_id;
    public LinkPreviewOptions $link_preview_options;
    public Animation $animation;
    public Audio $audio;
    public Document $document;
    public array  $photo;
    public Sticker $sticker;
    public Story $story;
    public Video $video;
    public VideoNote $video_note;
    public Voice $voice;
    public True $has_media_spoiler;
    public Contact $contact;
    public Dice $dice;
    public Game $game;
    public Giveaway $giveaway;
    public GiveawayWinners $giveaway_winners;
    public Invoice $invoice;
    public Location $location;
    public Poll $poll;
    public Venue $venue;
    
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
        if (isset($update['origin'])) $this->origin = new MessageOrigin($update['origin']);
        if (isset($update['chat'])) $this->chat = new Chat($update['chat']);
        if (isset($update['link_preview_options'])) $this->link_preview_options = new LinkPreviewOptions($update['link_preview_options']);
        if (isset($update['animation'])) $this->animation = new Animation($update['animation']);
        if (isset($update['audio'])) $this->audio = new Audio($update['audio']);
        if (isset($update['document'])) $this->document = new Document($update['document']);
        if (isset($update['sticker'])) $this->sticker = new Sticker($update['sticker']);
        if (isset($update['story'])) $this->story = new Story($update['story']);
        if (isset($update['video'])) $this->video = new Video($update['video']);
        if (isset($update['video_note'])) $this->video_note = new VideoNote($update['video_note']);
        if (isset($update['voice'])) $this->voice = new Voice($update['voice']);
        if (isset($update['contact'])) $this->contact = new Contact($update['contact']);
        if (isset($update['dice'])) $this->dice = new Dice($update['dice']);
        if (isset($update['game'])) $this->game = new Game($update['game']);
        if (isset($update['giveaway'])) $this->giveaway = new Giveaway($update['giveaway']);
        if (isset($update['giveaway_winners'])) $this->giveaway_winners = new GiveawayWinners($update['giveaway_winners']);
        if (isset($update['invoice'])) $this->invoice = new Invoice($update['invoice']);
        if (isset($update['location'])) $this->location = new Location($update['location']);
        if (isset($update['poll'])) $this->poll = new Poll($update['poll']);
        if (isset($update['venue'])) $this->venue = new Venue($update['venue']);
    }
}