<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests\Traits;

use Kuvardin\TelegramBotsApi\Types\KeyboardButton;
use Kuvardin\TelegramBotsApi\Types\ReplyKeyboardMarkup;

/**
 * Trait ReplyKeyboardMarkupEdit
 *
 * @package Kuvardin\TelegramBotsApi
 */
trait ReplyKeyboardMarkupEdit
{
    /**
     * @param ReplyKeyboardMarkup $reply_keyboard_markup
     * @return $this
     */
    public function setReplyKeyboardMarkup(ReplyKeyboardMarkup $reply_keyboard_markup): self
    {
        $this->params['reply_markup'] = $reply_keyboard_markup;
        return $this;
    }

    /**
     * @param KeyboardButton[][] $keyboard Array of button rows, each represented by an Array of KeyboardButton objects
     * @param  bool|null $resize_keyboard Requests clients to resize the keyboard vertically for optimal fit (e.g., make
     * the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case
     * the custom keyboard is always of the same height as the app's standard keyboard.
     * @param bool|null $one_time_keyboard Requests clients to hide the keyboard as soon as it's been used. The keyboard
     * will still be available, but clients will automatically display the usual letter-keyboard in the chat – the user
     * can press a special button in the input field to see the custom keyboard again. Defaults to false.
     * @param  bool|null $selective Use this parameter if you want to show the keyboard to specific users only. Targets:
     * 1) users that are @mentioned in the text of the Message object;
     * 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * Example: A user requests to change the bot‘s language, bot replies to the request with a keyboard
     * to select the new language. Other users in the group don’t see the keyboard.
     * @return $this
     */
    public function makeReplyKeyboardMarkup(array $keyboard, bool $resize_keyboard = null,
        bool $one_time_keyboard = null, bool $selective = null): self
    {
        $reply_keyboard_markup = ReplyKeyboardMarkup::make($keyboard);

        if ($resize_keyboard !== null) {
            $reply_keyboard_markup->resize_keyboard = $resize_keyboard;
        }

        if ($one_time_keyboard !== null) {
            $reply_keyboard_markup->one_time_keyboard = $one_time_keyboard;
        }

        if ($selective !== null) {
            $reply_keyboard_markup->selective = $selective;
        }

        $this->params['reply_markup'] = $reply_keyboard_markup;
        return $this;
    }
}
