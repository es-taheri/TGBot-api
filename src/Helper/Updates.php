<?php

namespace EasyTel\Helper;

use EasyTel\Telegram;
use JSON\json;

/**
 * @method object|string|array|null message() New incoming message of any kind - text, photo, sticker, etc.
 * @method object|string|array|null edited_message() New version of a message that is known to the bot and was edited. This update may at times be triggered by changes to message fields that are either unavailable or not actively used by your bot.
 * @method object|string|array|null channel_post() New incoming channel post of any kind - text, photo, sticker, etc.
 * @method object|string|array|null edited_channel_post() New version of a channel post that is known to the bot and was edited. This update may at times be triggered by changes to message fields that are either unavailable or not actively used by your bot.
 * @method object|string|array|null business_connection() The bot was connected to or disconnected from a business account, or a user edited an existing connection with the bot
 * @method object|string|array|null business_message() New message from a connected business account
 * @method object|string|array|null edited_business_message() New version of a message from a connected business account
 * @method object|string|array|null deleted_business_messages() Messages were deleted from a connected business account
 * @method object|string|array|null message_reaction() A reaction to a message was changed by a user. The bot must be an administrator in the chat and must explicitly specify "message_reaction" in the list of allowed_updates to receive these updates. The update isn't received for reactions set by bots.
 * @method object|string|array|null message_reaction_count() Reactions to a message with anonymous reactions were changed. The bot must be an administrator in the chat and must explicitly specify "message_reaction_count" in the list of allowed_updates to receive these updates. The updates are grouped and can be sent with delay up to a few minutes.
 * @method object|string|array|null inline_query() New incoming inline query
 * @method object|string|array|null chosen_inline_result() The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot.
 * @method object|string|array|null callback_query() New incoming callback query
 * @method object|string|array|null shipping_query() New incoming shipping query. Only for invoices with flexible price
 * @method object|string|array|null pre_checkout_query() New incoming pre-checkout query. Contains full information about checkout
 * @method object|string|array|null poll() New poll state. Bots receive only updates about manually stopped polls and polls, which are sent by the bot
 * @method object|string|array|null poll_answer() A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself.
 * @method object|string|array|null my_chat_member() The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.
 * @method object|string|array|null chat_member() A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify "chat_member" in the list of allowed_updates to receive these updates.
 * @method object|string|array|null chat_join_request() A request to join the chat has been sent. The bot must have the can_invite_users administrator right in the chat to receive these updates.
 * @method object|string|array|null chat_boost() A chat boost was added or changed. The bot must be an administrator in the chat to receive these updates.
 * @method object|string|array|null removed_chat_boost() A boost was removed from a chat. The bot must be an administrator in the chat to receive these updates.
 */
class Updates
{
    public object $updates;
    public int $output;
    public int $update_id;

    public function __construct(string $updates, int $output = Telegram::OUTPUT_OBJECT)
    {
        $this->updates = json_decode($updates);
        $this->update_id = $this->updates->update_id;
        $this->output = $output;
    }

    public function __call(string $name, array $arguments)
    {
        if (isset($this->updates->{$name})) {
            $data = $this->updates->{$name};
            return $this->output(json::_in(json::_out($data), true));
        } else {
            return null;
        }
    }

    private function output(array $data)
    {
        return match ($this->output) {
            Telegram::OUTPUT_JSON => json::_out($data, true),
            Telegram::OUTPUT_OBJECT => json::_in(json::_out($data)),
            default => $data,
        };
    }
}