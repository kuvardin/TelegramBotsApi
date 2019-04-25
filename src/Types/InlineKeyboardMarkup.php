<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represents an inline keyboard that appears right next to the message it belongs to
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class InlineKeyboardMarkup implements TypeInterface
{
    /**
     * @var InlineKeyboardButton[][] Array of button rows, each represented by an Array of InlineKeyboardButton objects
     */
    public $inline_keyboard;

    /**
     * InlineKeyboardMarkup constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->inline_keyboard = [];
        foreach ($data['inline_keyboard'] as $inline_keyboard_row) {
            $inline_keyboard_items = [];
            foreach ($inline_keyboard_row as $inline_keyboard_button) {
                $inline_keyboard_items[] = new InlineKeyboardButton($inline_keyboard_button);
            }
            $this->inline_keyboard[] = $inline_keyboard_items;
        }
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'inline_keyboard' => $this->inline_keyboard,
        ];
    }

    /**
     * @param array $inline_keyboard
     * @return InlineKeyboardMarkup
     */
    public static function make(array $inline_keyboard): self
    {
        return new self([
            'inline_keyboard' => $inline_keyboard,
        ]);
    }
}