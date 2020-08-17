<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests\Traits;

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
}
