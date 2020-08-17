<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests\Traits;

use Kuvardin\TelegramBotsApi\Types\ForceReply;

/**
 * Trait ForceReplyEdit
 *
 * @package Kuvardin\TelegramBotsApi
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
