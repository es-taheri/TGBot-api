<?php

namespace EasyTel\types;

use Nette\Utils\Json;

class Message
{
    public int $message_id;
    public int $message_thread_id;
    public User $from;
    public Chat $sender_chat;
    public int $date;
    public Chat $chat;
    public User $forward_from;
    public Chat $forward_from_chat;
    public int $forward_from_message_id;
    public string $forward_signature;
    public string $forward_sender_name;
    public int $forward_date;
    public True $is_topic_message;
    public True $is_automatic_forward;
    public Message $reply_to_message;
    public User $via_bot;
    public int $edit_date;
    public True $has_protected_content;
    public string $media_group_id;
    public string $author_signature;
    public string $text;
    public Json|string  $entities;
    public Animation $animation;
    public Audio $audio;
    public Document $document;
    public Json|string  $photo;
    public Sticker $sticker;
    public Story $story;
    public Video $video;
    public VideoNote $video_note;
    public Voice $voice;
    public string $caption;
    public Json|string  $caption_entities;
    public True $has_media_spoiler;
    public Contact $contact;
    public Dice $dice;
    public Game $game;
    public Poll $poll;
    public Venue $venue;
    public Location $location;
    public Json|string  $new_chat_members;
    public User $left_chat_member;
    public string $new_chat_title;
    public Json|string  $new_chat_photo;
    public True $delete_chat_photo;
    public True $group_chat_created;
    public True $supergroup_chat_created;
    public True $channel_chat_created;
    public MessageAutoDeleteTimerChanged $message_auto_delete_timer_changed;
    public int $migrate_to_chat_id;
    public int $migrate_from_chat_id;
    public Message $pinned_message;
    public Invoice $invoice;
    public SuccessfulPayment $successful_payment;
    public UserShared $user_shared;
    public ChatShared $chat_shared;
    public string $connected_website;
    public WriteAccessAllowed $write_access_allowed;
    public PassportData $passport_data;
    public ProximityAlertTriggered $proximity_alert_triggered;
    public ForumTopicCreated $forum_topic_created;
    public ForumTopicEdited $forum_topic_edited;
    public ForumTopicClosed $forum_topic_closed;
    public ForumTopicReopened $forum_topic_reopened;
    public GeneralForumTopicHidden $general_forum_topic_hidden;
    public GeneralForumTopicUnhidden $general_forum_topic_unhidden;
    public VideoChatScheduled $video_chat_scheduled;
    public VideoChatStarted $video_chat_started;
    public VideoChatEnded $video_chat_ended;
    public VideoChatParticipantsInvited $video_chat_participants_invited;
    public WebAppData $web_app_data;
    public Json|string $reply_markup;
    
    public function __construct(array $update)
    {
        $objects = array_keys($update);
        foreach ($objects as $object):
            $reflection=new \ReflectionClass(__CLASS__);
            $property=$reflection->getProperty($object);
            $type=$property->gettype()->getName();
            if(in_array($type,['bool','int','string','array','True','object','Json|string']))
                $this->{$object} = $update[$object];
        endforeach;
        if (isset($update['from'])) $this->from = new User($update['from']);
        if (isset($update['sender_chat'])) $this->sender_chat = new Chat($update['sender_chat']);
        if (isset($update['chat'])) $this->chat = new Chat($update['chat']);
        if (isset($update['forward_from'])) $this->forward_from = new User($update['forward_from']);
        if (isset($update['forward_from_chat'])) $this->forward_from_chat = new Chat($update['forward_from_chat']);
        if (isset($update['reply_to_message'])) $this->reply_to_message = new Message($update['reply_to_message']);
        if (isset($update['via_bot'])) $this->via_bot = new User($update['via_bot']);
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
        if (isset($update['poll'])) $this->poll = new Poll($update['poll']);
        if (isset($update['venue'])) $this->venue = new Venue($update['venue']);
        if (isset($update['location'])) $this->location = new Location($update['location']);
        if (isset($update['left_chat_member'])) $this->left_chat_member = new User($update['left_chat_member']);
        if (isset($update['message_auto_delete_timer_changed'])) $this->message_auto_delete_timer_changed = new MessageAutoDeleteTimerChanged($update['message_auto_delete_timer_changed']);
        if (isset($update['pinned_message'])) $this->pinned_message = new Message($update['pinned_message']);
        if (isset($update['invoice'])) $this->invoice = new Invoice($update['invoice']);
        if (isset($update['successful_payment'])) $this->successful_payment = new SuccessfulPayment($update['successful_payment']);
        if (isset($update['user_shared'])) $this->user_shared = new UserShared($update['user_shared']);
        if (isset($update['chat_shared'])) $this->chat_shared = new ChatShared($update['chat_shared']);
        if (isset($update['write_access_allowed'])) $this->write_access_allowed = new WriteAccessAllowed($update['write_access_allowed']);
        if (isset($update['passport_data'])) $this->passport_data = new PassportData($update['passport_data']);
        if (isset($update['proximity_alert_triggered'])) $this->proximity_alert_triggered = new ProximityAlertTriggered($update['proximity_alert_triggered']);
        if (isset($update['forum_topic_created'])) $this->forum_topic_created = new ForumTopicCreated($update['forum_topic_created']);
        if (isset($update['forum_topic_edited'])) $this->forum_topic_edited = new ForumTopicEdited($update['forum_topic_edited']);
        if (isset($update['forum_topic_closed'])) $this->forum_topic_closed = new ForumTopicClosed($update['forum_topic_closed']);
        if (isset($update['forum_topic_reopened'])) $this->forum_topic_reopened = new ForumTopicReopened($update['forum_topic_reopened']);
        if (isset($update['general_forum_topic_hidden'])) $this->general_forum_topic_hidden = new GeneralForumTopicHidden($update['general_forum_topic_hidden']);
        if (isset($update['general_forum_topic_unhidden'])) $this->general_forum_topic_unhidden = new GeneralForumTopicUnhidden($update['general_forum_topic_unhidden']);
        if (isset($update['video_chat_scheduled'])) $this->video_chat_scheduled = new VideoChatScheduled($update['video_chat_scheduled']);
        if (isset($update['video_chat_started'])) $this->video_chat_started = new VideoChatStarted($update['video_chat_started']);
        if (isset($update['video_chat_ended'])) $this->video_chat_ended = new VideoChatEnded($update['video_chat_ended']);
        if (isset($update['video_chat_participants_invited'])) $this->video_chat_participants_invited = new VideoChatParticipantsInvited($update['video_chat_participants_invited']);
        if (isset($update['web_app_data'])) $this->web_app_data = new WebAppData($update['web_app_data']);
    }
}