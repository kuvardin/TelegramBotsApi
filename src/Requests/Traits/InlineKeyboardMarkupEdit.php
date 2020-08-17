<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests\Traits;

use Kuvardin\TelegramBotsApi\Types\InlineKeyboardMarkup;

/**
 * Trait InlineKeyboardMarkupEdit
 *
 * @package Kuvardin\TelegramBotsApi
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
