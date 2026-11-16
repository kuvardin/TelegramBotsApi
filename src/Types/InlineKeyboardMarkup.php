<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents an inline keyboard that appears right next to the message it belongs to.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InlineKeyboardMarkup extends Type
{
    /**
     * @param InlineKeyboardButton[][] $inline_keyboard Array of button rows, each represented by an Array of
     *     InlineKeyboardButton objects
     * @param bool|null $force_reply Pass True if the reply interface must be shown to the user, as if they had
     *     manually selected the bot's message and tapped 'Reply'. The value of the field can't be changed when the
     *     inline keyboard is edited.
     */
    public function __construct(
        public array $inline_keyboard,
        public ?bool $force_reply = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        $result = new self(
            inline_keyboard: [],
            force_reply: $data['force_reply'] ?? null,
        );

        foreach ($data['inline_keyboard'] as $buttons_row_data) {
            $buttons_row = [];
            foreach ($buttons_row_data as $button_data) {
                $buttons_row[] = InlineKeyboardButton::makeByArray($button_data);
            }
            $result->inline_keyboard[] = $buttons_row;
        }

        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'inline_keyboard' => $this->inline_keyboard,
            'force_reply' => $this->force_reply,
        ];
    }
}
