<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents an <a href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline
 * keyboard</a> that appears right next to the message it belongs to.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InlineKeyboardMarkup extends Type
{
    /**
     * @param InlineKeyboardButton[][] $inline_keyboard Array of button rows, each represented by an Array of
     *     InlineKeyboardButton objects
     */
    public function __construct(
        public array $inline_keyboard,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        $result = new self(
            inline_keyboard: [],
        );

        foreach ($data['inline_keyboard'] as $buttons_row_data) {
            $buttons_row = [];
            foreach ($buttons_row_data as $button_data) {
                $buttons_row[] = InlineKeyboardMarkup::makeByArray($button_data);
            }
            $result->inline_keyboard[] = $buttons_row;
        }
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'inline_keyboard' => $this->inline_keyboard,
        ];
    }
}
