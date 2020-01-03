<?php declare(strict_types=1);

namespace TelegramBotsApi\Requests\Traits;

use TelegramBotsApi\Types\Message;

/**
 * Trait ReplyToMessageEdit
 *
 * @package TelegramBotsApi\Requests\Traits
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