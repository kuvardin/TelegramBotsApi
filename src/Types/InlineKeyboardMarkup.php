<?php

declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * This object represents an inline keyboard that appears right next to the message it belongs to.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InlineKeyboardMarkup implements TypeInterface
{
    /**
     * @var InlineKeyboardButton[][] Array of button rows, each represented by an Array of
     * InlineKeyboardButton objects
     */
    public array $inline_keyboard = [];

    /**
     * InlineKeyboardMarkup constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data['inline_keyboard'] as $row) {
            $buttons_row = [];
            foreach ($row as $button) {
                $buttons_row[] = $button instanceof InlineKeyboardButton
                    ? $button
                    : new InlineKeyboardButton($button);
            }
            $this->inline_keyboard[] = $buttons_row;
        }
    }

    /**
     * @param InlineKeyboardButton[][] $inline_keyboard Array of button rows, each represented by an
     * Array of InlineKeyboardButton objects
     * @return InlineKeyboardMarkup
     */
    public static function make(array $inline_keyboard): self
    {
        return new self([
            'inline_keyboard' => $inline_keyboard,
        ]);
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
}
