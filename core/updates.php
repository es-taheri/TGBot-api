<?php

namespace EasyTel\core;

use Nette\Utils\Arrays;
use Nette\Utils\Json;
use stdClass;

class updates
{
    public object $updates;
    public int $output;
    public int $update_id;
    public const OUTPUT_JSON = 111;
    public const OUTPUT_OBJECT = 112;
    public const OUTPUT_ARRAY = 113;

    public function __construct(Json|string $updates, int $output = self::OUTPUT_OBJECT)
    {
        $this->updates = json_decode($updates);
        $this->update_id = $this->updates->update_id;
        $this->output=$output;
    }

    /**
     * This method returns new incoming message of any kind - text, photo, sticker, etc.
     *
     * @return object|string|array
     */
    public function message(): object|string|array
    {
        $data = $this->updates->{__FUNCTION__};
        return self::output(get_object_vars($data));
    }

    /**
     * This method returns new version of a message that is known to the bot and was edited
     *
     * @return object|string|array
     */
    public function edited_message(): object|string|array
    {
        $data = $this->updates->{__FUNCTION__};
        return self::output(get_object_vars($data));
    }

    /**
     * New incoming channel post of any kind - text, photo, sticker, etc.
     *
     * @return object|string|array
     */
    public function channel_post(): object|string|array
    {
        $data = $this->updates->{__FUNCTION__};
        return self::output(get_object_vars($data));
    }

    /**
     * New version of a channel post that is known to the bot and was edited
     *
     * @return object|string|array
     */
    public function edited_channel_post(): object|string|array
    {
        $data = $this->updates->{__FUNCTION__};
        return self::output(get_object_vars($data));
    }

    /**
     * New incoming inline query
     *
     * @return object|string|array
     */
    public function inline_query(): object|string|array
    {
        $data = $this->updates->{__FUNCTION__};
        return self::output(get_object_vars($data));
    }

    /**
     * The result of an inline query that was chosen by a user and sent to their chat partner.
     * Please see our documentation on the feedback collecting for details on how to enable these updates for your bot.
     *
     * @return object|string|array
     */
    public function chosen_inline_result(): object|string|array
    {
        $data = $this->updates->{__FUNCTION__};
        return self::output(get_object_vars($data));
    }

    /**
     * New incoming callback query
     *
     * @return object|string|array
     */
    public function callback_query(): object|string|array
    {
        $data = $this->updates->{__FUNCTION__};
        return self::output(get_object_vars($data));
    }

    /**
     * New incoming shipping query. Only for invoices with flexible price
     *
     * @return object|string|array
     */
    public function shipping_query(): object|string|array
    {
        $data = $this->updates->{__FUNCTION__};
        return self::output(get_object_vars($data));
    }

    /**
     * New incoming pre-checkout query. Contains full information about checkout
     *
     * @return object|string|array
     */
    public function pre_checkout_query(): object|string|array
    {
        $data = $this->updates->{__FUNCTION__};
        return self::output(get_object_vars($data));
    }

    /**
     * New poll state. Bots receive only updates about stopped polls and polls, which are sent by the bot
     *
     * @return object|string|array
     */
    public function poll(): object|string|array
    {
        $data = $this->updates->{__FUNCTION__};
        return self::output(get_object_vars($data));
    }

    /**
     * A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself.
     *
     * @return object|string|array
     */
    public function poll_answer(): object|string|array
    {
        $data = $this->updates->{__FUNCTION__};
        return self::output(get_object_vars($data));
    }

    /**
     * The bot's chat member status was updated in a chat.
     * For private chats, this update is received only when the bot is blocked or unblocked by the user.
     *
     * @return object|string|array
     */
    public function my_chat_member(): object|string|array
    {
        $data = $this->updates->{__FUNCTION__};
        return self::output(get_object_vars($data));
    }

    /**
     * A chat member's status was updated in a chat.
     * The bot must be an administrator in the chat and must explicitly specify "chat_member" in the list of allowed_updates to receive these updates.
     *
     * @return object|string|array
     */
    public function chat_member(): object|string|array
    {
        $data = $this->updates->{__FUNCTION__};
        return self::output(get_object_vars($data));
    }

    /**
     * A request to join the chat has been sent.
     * The bot must have the can_invite_users administrator right in the chat to receive these updates.
     *
     * @return object|string|array
     */
    public function chat_join_request(): object|string|array
    {
        $data = $this->updates->{__FUNCTION__};
        return self::output(get_object_vars($data));
    }

    private function output($data)
    {
        switch ($this->output):
            case self::OUTPUT_JSON:
                $return = Json::encode($data, true);
            break;
            case self::OUTPUT_OBJECT:
                $return = new stdClass();
                Arrays::toObject($data, $return);
            break;
            default:
                $return = $data;
            break;
        endswitch;
        return $return;
    }

}