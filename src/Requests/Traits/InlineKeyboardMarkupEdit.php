<?php

declare(strict_types=1);

namespace TelegramBotsApi\Requests\Traits;

use TelegramBotsApi\Types\InlineKeyboardMarkup;

/**
 * Trait InlineKeyboardMarkupEdit
 *
 * @package TelegramBotsApi\Requests\Traits
 */
trait InlineKeyboardMarkupEdit
{
    /**
     * @param InlineKeyboardMarkup $inline_keyboard_markup
     * @return $this
     */
    public function setInlineKeyboardMarkup(InlineKeyboardMarkup $inline_keyboard_markup): self
    {
        $this->params['reply_markup'] = $inline_keyboard_markup;
        return $this;
    }
}
