<?php

declare(strict_types=1);

namespace TelegramBotsApi\Requests\Traits;

use TelegramBotsApi\Types\ForceReply;

/**
 * Trait ForceReplyEdit
 *
 * @package TelegramBotsApi\Requests\Traits
 */
trait ForceReplyEdit
{
    /**
     * @param bool|null $selective
     * @return $this
     */
    public function addForceReply(bool $selective = null): self
    {
        $force_reply = ForceReply::make();
        $force_reply->selective = $selective;
        $this->params['reply_markup'] = $force_reply;
        return $this;
    }
}
