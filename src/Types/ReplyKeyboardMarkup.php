<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represents a custom keyboard with reply options (see Introduction to bots for details and examples)
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class ReplyKeyboardMarkup implements TypeInterface
{

    /**
     * @var KeyboardButton[][] Array of button rows, each represented by an Array of KeyboardButton objects
     */
    public $keyboard;

    /**
     * @var bool|null Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
     */
    public $resize_keyboard;

    /**
     * @var bool|null Requests clients to hide the keyboard as soon as it's been used. The keyboard will still be available, but clients will automatically display the usual letter-keyboard in the chat – the user can press a special button in the input field to see the custom keyboard again. Defaults to false.
     */
    public $one_time_keyboard;

    /**
     * @var bool|null Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     */
    public $selective;

    /**
     * ReplyKeyboardMarkup constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->keyboard = [];
        foreach ($data['keyboard'] as $keyboard_row) {
            $keyboard_items = [];
            foreach ($keyboard_row as $keyboard_button) {
                $keyboard_items[] = $keyboard_button instanceof KeyboardButton ? $keyboard_button : new KeyboardButton($keyboard_button);
            }
            $this->keyboard[] = $keyboard_items;
        }

        $this->resize_keyboard = $data['resize_keyboard'] ?? null;
        $this->one_time_keyboard = $data['one_time_keyboard'] ?? null;
        $this->selective = $data['selective'] ?? null;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'keyboard' => $this->keyboard,
            'resize_keyboard' => $this->resize_keyboard,
            'one_time_keyboard' => $this->one_time_keyboard,
            'selective' => $this->selective,
        ];
    }

    /**
     * @param array $keyboard
     * @return ReplyKeyboardMarkup
     */
    public static function make(array $keyboard): self
    {
        return new self([
            'keyboard' => $keyboard,
        ]);
    }
}