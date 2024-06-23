<?php

namespace EasyTel;

use JSON\json;

/**
 * @method bool is_persistent(bool $status = null) Requests clients to always show the keyboard when the regular keyboard is hidden.<br/>Defaults to false, in which case the custom keyboard can be hidden and opened with a keyboard icon.<br>Get current status by not setting the parameter.
 * @method bool resize_keyboard(bool $status = null) Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons).<br>Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.<br>Get current status by not setting the parameter.
 * @method bool one_time_keyboard(bool $status = null) Requests clients to hide the keyboard as soon as it's been used.<br>The keyboard will still be available, but clients will automatically display the usual letter-keyboard in the chat<br>The user can press a special button in the input field to see the custom keyboard again.<br>Defaults to false.<br>Get current status by not setting the parameter.
 * @method string|true input_field_placeholder(string $text = null) The placeholder to be shown in the input field when the keyboard is active;1-64 characters<br>Get current status by not setting the parameter.
 * @method bool selective(bool $status = null) Use this parameter if you want to show the keyboard to specific users only.<br>Targets:<br>1) users that are mentioned in the text of the Message object;<br>2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.<br>Example: A user requests to change the bot's language, bot replies to the request with a keyboard to select the new language.<br>Other users in the group don't see the keyboard.<br>Get current status by not setting the parameter.
 */
class Keyboard
{
    public array $keyboard;
    public array $buttons;
    public int $format;
    public const OUTPUT_JSON = 111;
    public const OUTPUT_OBJECT = 112;
    public const OUTPUT_ARRAY = 113;
    public const DEFAULT_KEYBOARD = [
        'keyboard' => [],
        'is_persistent' => null,
        'resize_keyboard' => null,
        'one_time_keyboard' => null,
        'input_field_placeholder' => null,
        'selective' => null
    ];

    public function __construct(array $keyboard = self::DEFAULT_KEYBOARD, array $buttons = [], int $format = self::OUTPUT_JSON
    )
    {
        $this->keyboard = $keyboard;
        $this->buttons = $buttons;
        $this->format = $format;
    }

    /**
     * Use this method to add a button to keyboard buttons.\
     * The optional fields web_app, request_user, request_chat, request_contact, request_location, and request_poll are mutually exclusive.
     *
     * @param string $text
     * @param int|null $row
     * @param int|null $column
     * @param string|null $request_user
     * @param string|null $request_chat
     * @param bool|null $request_contact
     * @param bool|null $request_location
     * @param string|null $request_poll
     * @param string|null $web_app
     * @return array
     */
    public function KeyboardButton_add(
        string $text, int $row = null, int $column = null, string $request_user = null, string $request_chat = null,
        bool   $request_contact = null, bool $request_location = null, string $request_poll = null, string $web_app = null
    ): array
    {
        if (is_null($row) && count($this->buttons) == 0)
            $row = 1;
        else
            $row = (is_null($row)) ? count($this->buttons) : $row;
        $row--;
        if (empty($this->buttons[$row])):
            $column = 1;
        else:
            $column = (is_null($column)) ? count($this->buttons[$row]) + 1 : $column;
        endif;
        if ($column > 5):
            $row++;
            $column = 1;
        endif;
        $column--;
        $parameters = [
            'text' => $text,
            'request_user' => $request_user,
            'request_chat' => $request_chat,
            'request_contact' => $request_contact,
            'request_location' => $request_location,
            'request_poll' => $request_poll,
            'web_app' => $web_app
        ];
        if (is_null($parameters['request_user'])) unset($parameters['request_user']);
        if (is_null($parameters['request_chat'])) unset($parameters['request_chat']);
        if (is_null($parameters['request_contact'])) unset($parameters['request_contact']);
        if (is_null($parameters['request_location'])) unset($parameters['request_location']);
        if (is_null($parameters['request_poll'])) unset($parameters['request_poll']);
        if (is_null($parameters['web_app'])) unset($parameters['web_app']);
        $this->buttons[$row][$column] = $parameters;
        return $this->buttons;
    }

    /**
     * Use this method to edit a button on keyboard buttons.\
     * The optional fields web_app, request_user, request_chat, request_contact, request_location, and request_poll are mutually exclusive.
     *
     * @param int|null $row
     * @param int|null $column
     * @param string|null $text
     * @param string|null $request_user
     * @param string|null $request_chat
     * @param bool|null $request_contact
     * @param bool|null $request_location
     * @param string|null $request_poll
     * @param string|null $web_app
     * @return bool
     */
    public function KeyboardButton_edit(
        int  $row = null, int $column = null, string $text = null, string $request_user = null, string $request_chat = null,
        bool $request_contact = null, bool $request_location = null, string $request_poll = null, string $web_app = null
    ): bool
    {
        if (!empty($this->buttons[$row - 1][$column - 1])) {
            $button = $this->buttons[$row - 1][$column - 1];
            $button['text'] = $text ?? $button['text'];
            $button['request_user'] = $request_user ?? $button['request_user'];
            $button['request_chat'] = $request_chat ?? $button['request_chat'];
            $button['request_contact'] = $request_contact ?? $button['request_contact'];
            $button['request_location'] = $request_location ?? $button['request_location'];
            $button['request_poll'] = $request_poll ?? $button['request_poll'];
            $button['web_app'] = $web_app ?? $button['web_app'];
            if (is_null($button['request_user'])) unset($button['request_user']);
            if (is_null($button['request_chat'])) unset($button['request_chat']);
            if (is_null($button['request_contact'])) unset($button['request_contact']);
            if (is_null($button['request_location'])) unset($button['request_location']);
            if (is_null($button['request_poll'])) unset($button['request_poll']);
            if (is_null($button['web_app'])) unset($button['web_app']);
            $this->buttons[$row - 1][$column - 1] = $button;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Use this method to get a button on keyboard buttons. Return False if row or column empty!\
     * If column not set returns all buttons in row.\
     * If row and column not set returns all buttons.
     *
     * @param int $row
     * @param int|null $column
     * @return array|false
     */
    public function KeyboardButton_get(int $row = null, int $column = null): array|false
    {
        if (is_null($row) && is_null($column)) {
            if (!empty($this->buttons)):
                return $this->buttons;
            else:
                return false;
            endif;
        } elseif (is_null($column)) {
            if (!empty($this->buttons[$row - 1])):
                return $this->buttons[$row - 1];
            else:
                return false;
            endif;
        } else {
            if (!empty($this->buttons[$row - 1][$column - 1]))
                return $this->buttons[$row - 1][$column - 1];
            else
                return false;
        }
    }

    /**
     * Use this method to remove a button on keyboard buttons. Return False if row or column empty!\
     * If column not set remove all buttons in row.\
     * If row and column not set will remove all buttons.
     *
     * @param int|null $row
     * @param int|null $column
     * @return bool
     */
    public function KeyboardButton_remove(int $row = null, int $column = null): bool
    {
        if (is_null($row) && is_null($column)) {
            if (!empty($this->buttons)):
                $this->buttons = [];
                return true;
            else:
                return false;
            endif;
        } elseif (is_null($column)) {
            if (!empty($this->buttons[$row - 1])):
                unset($this->buttons[$row - 1]);
                $this->buttons = array_values($this->buttons);
                return true;
            else:
                return false;
            endif;
        } else {
            if (!empty($this->buttons[$row - 1][$column - 1])):
                unset($this->buttons[$row - 1][$column - 1]);
                $this->buttons = array_values($this->buttons);
                return true;
            else:
                return false;
            endif;
        }

    }

    public function __call(string $name, array $arguments)
    {
        $argument = array_shift($arguments);
        $return = true;
        if (is_null($argument))
            $return = $this->keyboard[$name];
        else
            $this->keyboard[$name] = $argument;
        return $return;
    }

    /**
     * Returns full structured ReplyKeyboardMarkup with chosen format.\
     * Keyboard settings you changed with these method parameters temporary.
     * You should use their method for apply your preferred keyboard settings always.
     *
     * @param bool|null $is_persistent
     * @param bool|null $resize_keyboard
     * @param bool|null $one_time_keyboard
     * @param string|null $input_field_placeholder
     * @param bool|null $selective
     * @return array|object|string
     */
    public function ReplyKeyboardMarkup(
        bool   $is_persistent = null,
        bool   $resize_keyboard = null,
        bool   $one_time_keyboard = null,
        string $input_field_placeholder = null,
        bool   $selective = null
    ): array|object|string
    {
        $this->keyboard['keyboard'] = $this->buttons;
        $keyboard = $this->keyboard;
        $keyboard['is_persistent'] = $is_persistent ?? $keyboard['is_persistent'];
        $keyboard['resize_keyboard'] = $resize_keyboard ?? $keyboard['resize_keyboard'];
        $keyboard['one_time_keyboard'] = $one_time_keyboard ?? $keyboard['one_time_keyboard'];
        $keyboard['input_field_placeholder'] = $input_field_placeholder ?? $keyboard['input_field_placeholder'];
        $keyboard['selective'] = $selective ?? $keyboard['selective'];
        if (is_null($keyboard['is_persistent'])) unset($keyboard['is_persistent']);
        if (is_null($keyboard['resize_keyboard'])) unset($keyboard['resize_keyboard']);
        if (is_null($keyboard['one_time_keyboard'])) unset($keyboard['one_time_keyboard']);
        if (is_null($keyboard['input_field_placeholder'])) unset($keyboard['input_field_placeholder']);
        if (is_null($keyboard['selective'])) unset($keyboard['selective']);
        return $this->output($keyboard);
    }

    /**
     * This method build an object defines the criteria used to request a suitable user.\
     * The identifier of the selected user will be shared with the bot when the corresponding button is pressed.
     *
     * @param int $request_id
     * @param bool|null $user_is_bot
     * @param bool|null $user_is_premium
     * @return array
     */
    public static function KeyboardButtonRequestUser(int $request_id, bool $user_is_bot = null, bool $user_is_premium = null): array
    {
        $parameters = [
            'request_id' => $request_id,
            'user_is_bot' => $user_is_bot,
            'user_is_premium' => $user_is_premium,
        ];
        if (is_null($parameters['user_is_bot'])) unset($parameters['user_is_bot']);
        if (is_null($parameters['user_is_premium'])) unset($parameters['user_is_premium']);
        return $parameters;
    }

    /**
     * This method build an object defines the criteria used to request a suitable chat.\
     * The identifier of the selected chat will be shared with the bot when the corresponding button is pressed.
     *
     * @param int $request_id
     * @param bool|null $chat_is_channel
     * @param bool|null $chat_is_forum
     * @param bool|null $chat_has_username
     * @param bool|null $chat_is_created
     * @param string|null $user_administrator_rights
     * @param string|null $bot_administrator_rights
     * @param bool|null $bot_is_member
     * @return array
     */
    public static function KeyboardButtonRequestChat(
        int  $request_id, bool $chat_is_channel = null, bool $chat_is_forum = null, bool $chat_has_username = null,
        bool $chat_is_created = null, string $user_administrator_rights = null, string $bot_administrator_rights = null,
        bool $bot_is_member = null
    ): array
    {
        $parameters = [
            'request_id' => $request_id,
            'chat_is_channel' => $chat_is_channel,
            'chat_is_forum' => $chat_is_forum,
            'chat_has_username' => $chat_has_username,
            'chat_is_created' => $chat_is_created,
            'user_administrator_rights' => $user_administrator_rights,
            'bot_administrator_rights' => $bot_administrator_rights,
            'bot_is_member' => $bot_is_member,
        ];
        if (is_null($parameters['user_is_bot'])) unset($parameters['user_is_bot']);
        if (is_null($parameters['chat_is_channel'])) unset($parameters['chat_is_channel']);
        if (is_null($parameters['chat_is_forum'])) unset($parameters['chat_is_forum']);
        if (is_null($parameters['chat_has_username'])) unset($parameters['chat_has_username']);
        if (is_null($parameters['chat_is_created'])) unset($parameters['chat_is_created']);
        if (is_null($parameters['user_administrator_rights'])) unset($parameters['user_administrator_rights']);
        if (is_null($parameters['bot_administrator_rights'])) unset($parameters['bot_administrator_rights']);
        if (is_null($parameters['bot_is_member'])) unset($parameters['bot_is_member']);
        return $parameters;
    }

    /**
     * This method build an object represents type of a poll,
     * which is allowed to be created and sent when the corresponding button is pressed.
     * @param string|null $type
     * @return array
     */
    public static function KeyboardButtonPollType(string $type = null): array
    {
        $parameters = ['type' => $type];
        if (is_null($parameters['type'])) unset($parameters['type']);
        return $parameters;
    }

    /**
     * Upon receiving a message with this object,
     * Telegram clients will remove the current custom keyboard and display the default letter-keyboard.\
     * By default, custom keyboards are displayed until a new keyboard is sent by a bot.\
     * An exception is made for one-time keyboards that are hidden immediately after the user presses a button.
     *
     * @param bool $remove_keyboard
     * @param bool|null $selective
     * @return array
     */
    public static function ReplyKeyboardRemove(bool $remove_keyboard, bool $selective = null): array
    {
        $parameters = [
            'remove_keyboard' => $remove_keyboard,
            'selective' => $selective,
        ];
        if (is_null($parameters['selective'])) unset($parameters['selective']);
        return $parameters;
    }

    private function output($data)
    {
        return match ($this->format) {
            self::OUTPUT_JSON => json::_out($data, true),
            self::OUTPUT_OBJECT => json::_in(json::_out($data)),
            default => $data,
        };
    }
}