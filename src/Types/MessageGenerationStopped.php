<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes an update about a user stopping message generation.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class MessageGenerationStopped extends Type
{
    /**
     * @param Chat $chat Chat in which the message is generated
     * @param int $draft_id Unique identifier of the message draft which was stopped
     * @param int|null $message_thread_id Unique identifier of the message thread in which the message is generated
     */
    public function __construct(
        public Chat $chat,
        public int $draft_id,
        public int|null $message_thread_id = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            chat: Chat::makeByArray($data['chat']),
            draft_id: $data['draft_id'],
            message_thread_id: $data['message_thread_id'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'chat' => $this->chat,
            'draft_id' => $this->draft_id,
            'message_thread_id' => $this->message_thread_id,
        ];
    }
}





