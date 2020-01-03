<?php declare(strict_types=1);

namespace TelegramBotsApi\Requests\Traits;

use TelegramBotsApi\Types\ReplyKeyboardMarkup;

/**
 * Trait ReplyKeyboardMarkupEdit
 *
 * @package TelegramBotsApi\Requests\Traits
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