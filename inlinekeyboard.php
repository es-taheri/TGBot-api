<?php

namespace EasyTel;

use Nette\Utils\Arrays;
use Nette\Utils\Json;
use stdClass;

class inlinekeyboard
{
    public array $keyboard;
    public array $buttons;
    public int $format;
    public const OUTPUT_JSON = 111;
    public const OUTPUT_OBJECT = 112;
    public const OUTPUT_ARRAY = 113;
    public const DEFAULT_KEYBOARD = [
        'inline_keyboard' => []
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
     * @param string|null $url
     * @param string|null $callback_data
     * @param Json|string|null $web_app
     * @param Json|string|null $login_url
     * @param string|null $switch_inline_query
     * @param string|null $switch_inline_query_current_chat
     * @param Json|string|null $switch_inline_query_chosen_chat
     * @param Json|string|null $callback_game
     * @param bool|null $pay
     * @return array
     */
    public function InlineKeyboardButton_add(
        string      $text, int $row = null, int $column = null, string $callback_data = null, string $url = null,
        Json|string $web_app = null, Json|string $login_url = null, string $switch_inline_query = null,
        string      $switch_inline_query_current_chat = null, Json|string $switch_inline_query_chosen_chat = null,
        Json|string $callback_game = null, bool $pay = null
    ): array
    {
        if (is_null($row) && count($this->buttons) == 0)
            $row = 1;
        else
            $row = (is_null($row)) ? count($this->buttons) : $row;
        if (!empty($this->buttons[$row]))
            $column = (is_null($column)) ? count($this->buttons[$row]) : $column;
        else
            $column = 1;
        if ($column > 5):
            $row++;
            $column = 1;
        endif;
        $row--;
        $column--;
        $this->buttons[$row][$column] = [
            'text' => $text,
            'url' => $url,
            'callback_data' => $callback_data,
            'web_app' => $web_app,
            'login_url' => $login_url,
            'switch_inline_query' => $switch_inline_query,
            'switch_inline_query_current_chat' => $switch_inline_query_current_chat,
            'switch_inline_query_chosen_chat' => $switch_inline_query_chosen_chat,
            'callback_game' => $callback_game,
            'pay' => $pay,
        ];
        return $this->buttons;
    }

    /**
     * Use this method to edit a button on keyboard buttons.\
     * The optional fields web_app, request_user, request_chat, request_contact, request_location, and request_poll are mutually exclusive.
     *
     * @param int|null $row
     * @param int|null $column
     * @param string|null $url
     * @param string|null $callback_data
     * @param Json|string|null $web_app
     * @param Json|string|null $login_url
     * @param string|null $switch_inline_query
     * @param string|null $switch_inline_query_current_chat
     * @param Json|string|null $switch_inline_query_chosen_chat
     * @param Json|string|null $callback_game
     * @param bool|null $pay
     * @return bool
     */
    public function InlineKeyboardButton_edit(
        int         $row = null, int $column = null, string $text = null, string $callback_data = null, string $url = null,
        Json|string $web_app = null, Json|string $login_url = null, string $switch_inline_query = null,
        string      $switch_inline_query_current_chat = null, Json|string $switch_inline_query_chosen_chat = null,
        Json|string $callback_game = null, bool $pay = null
    ): bool
    {
        if (!empty($this->buttons[$row - 1][$column - 1])) {
            $button = $this->buttons[$row - 1][$column - 1];
            $button['text'] = $text ?? $button['text'];
            $button['url'] = $url ?? $button['url'];
            $button['callback_data'] = $callback_data ?? $button['callback_data'];
            $button['web_app'] = $web_app ?? $button['web_app'];
            $button['login_url'] = $login_url ?? $button['login_url'];
            $button['switch_inline_query'] = $switch_inline_query ?? $button['switch_inline_query'];
            $button['switch_inline_query_current_chat'] = $switch_inline_query_current_chat ?? $button['switch_inline_query_current_chat'];
            $button['switch_inline_query_chosen_chat'] = $switch_inline_query_chosen_chat ?? $button['switch_inline_query_chosen_chat'];
            $button['callback_game'] = $callback_game ?? $button['callback_game'];
            $button['pay'] = $pay ?? $button['pay'];
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
    public function InlineKeyboardButton_get(int $row=null, int $column = null): array|false
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
    public function InlineKeyboardButton_remove(int $row = null, int $column = null): bool
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

    /**
     * Returns full structured InlineKeyboardMarkup with chosen format.
     *
     * @return array
     */
    public function InlineKeyboardMarkup(): array|object|string
    {
        $this->keyboard['inline_keyboard'] = $this->buttons;
        return self::output($this->keyboard);
    }

    private function output($data)
    {
        switch ($this->format):
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