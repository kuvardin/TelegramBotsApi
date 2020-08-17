<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests\Traits;

use Kuvardin\TelegramBotsApi\Types\ReplyKeyboardRemove;

/**
 * Trait ReplyKeyboardRemovingEdit
 *
 * @package Kuvardin\TelegramBotsApi
 */
trait ReplyKeyboardRemovingEdit
{
    /**
     * @param bool|null $selective
     * @return $this
     */
    public function removeReplyKeyboard(bool $selective = null): self
    {
        $reply_keyboard_remove = ReplyKeyboardRemove::make();
        $reply_keyboard_remove->selective = $selective;
        $this->params['reply_markup'] = $reply_keyboard_remove;
        return $this;
    }
}
