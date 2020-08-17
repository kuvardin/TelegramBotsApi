<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests\Traits;

use Kuvardin\TelegramBotsApi\Types\Message;

/**
 * Trait ReplyToMessageEdit
 *
 * @package Kuvardin\TelegramBotsApi
 */
trait ReplyToMessageEdit
{
    /**
     * @param Message $message
     * @return $this
     */
    public function setReplyToMessage(Message $message): self
    {
        $this->params['reply_to_message_id'] = $message->message_id;
        return $this;
    }

    /**
     * @param int $message_id
     * @return $this
     */
    public function setReplyToMessageWithId(int $message_id): self
    {
        $this->params['reply_to_message_id'] = $message_id;
        return $this;
    }
}
