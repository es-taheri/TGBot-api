<?php

namespace EasyTel\Types;

class Update
{
    public int $update_id;
    public Message $message;
    public Message $edited_message;
    public Message $channel_post;
    public Message $edited_channel_post;
    public BusinessConnection $business_connection;
    public Message $business_message;
    public Message $edited_business_message;
    public BusinessMessagesDeleted $deleted_business_messages;
    public MessageReactionUpdated $message_reaction;
    public MessageReactionCountUpdated $message_reaction_count;
    public InlineQuery $inline_query;
    public ChosenInlineResult $chosen_inline_result;
    public CallbackQuery $callback_query;
    public ShippingQuery $shipping_query;
    public PreCheckoutQuery $pre_checkout_query;
    public Poll $poll;
    public PollAnswer $poll_answer;
    public ChatMemberUpdated $my_chat_member;
    public ChatMemberUpdated $chat_member;
    public ChatJoinRequest $chat_join_request;
    public ChatBoostUpdated $chat_boost;
    public ChatBoostRemoved $removed_chat_boost;
    
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
        if (isset($update['message'])) $this->message = new Message($update['message']);
        if (isset($update['edited_message'])) $this->edited_message = new Message($update['edited_message']);
        if (isset($update['channel_post'])) $this->channel_post = new Message($update['channel_post']);
        if (isset($update['edited_channel_post'])) $this->edited_channel_post = new Message($update['edited_channel_post']);
        if (isset($update['business_connection'])) $this->business_connection = new BusinessConnection($update['business_connection']);
        if (isset($update['business_message'])) $this->business_message = new Message($update['business_message']);
        if (isset($update['edited_business_message'])) $this->edited_business_message = new Message($update['edited_business_message']);
        if (isset($update['deleted_business_messages'])) $this->deleted_business_messages = new BusinessMessagesDeleted($update['deleted_business_messages']);
        if (isset($update['message_reaction'])) $this->message_reaction = new MessageReactionUpdated($update['message_reaction']);
        if (isset($update['message_reaction_count'])) $this->message_reaction_count = new MessageReactionCountUpdated($update['message_reaction_count']);
        if (isset($update['inline_query'])) $this->inline_query = new InlineQuery($update['inline_query']);
        if (isset($update['chosen_inline_result'])) $this->chosen_inline_result = new ChosenInlineResult($update['chosen_inline_result']);
        if (isset($update['callback_query'])) $this->callback_query = new CallbackQuery($update['callback_query']);
        if (isset($update['shipping_query'])) $this->shipping_query = new ShippingQuery($update['shipping_query']);
        if (isset($update['pre_checkout_query'])) $this->pre_checkout_query = new PreCheckoutQuery($update['pre_checkout_query']);
        if (isset($update['poll'])) $this->poll = new Poll($update['poll']);
        if (isset($update['poll_answer'])) $this->poll_answer = new PollAnswer($update['poll_answer']);
        if (isset($update['my_chat_member'])) $this->my_chat_member = new ChatMemberUpdated($update['my_chat_member']);
        if (isset($update['chat_member'])) $this->chat_member = new ChatMemberUpdated($update['chat_member']);
        if (isset($update['chat_join_request'])) $this->chat_join_request = new ChatJoinRequest($update['chat_join_request']);
        if (isset($update['chat_boost'])) $this->chat_boost = new ChatBoostUpdated($update['chat_boost']);
        if (isset($update['removed_chat_boost'])) $this->removed_chat_boost = new ChatBoostRemoved($update['removed_chat_boost']);
    }
}