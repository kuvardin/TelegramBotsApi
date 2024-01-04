<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents reaction changes on a message with anonymous reactions.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class MessageReactionCountUpdated extends Type
{
    /**
     * @param Chat $chat The chat containing the message
     * @param int $message_id Unique message identifier inside the chat
     * @param int $date Date of the change in Unix time
     * @param ReactionCount[] $reactions List of reactions that are present on the message
     */
    public function __construct(
        public Chat $chat,
        public int $message_id,
        public int $date,
        public array $reactions,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            chat: Chat::makeByArray($data['chat']),
            message_id: $data['message_id'],
            date: $data['date'],
            reactions: array_map(
                static fn(array $item_data) => ReactionCount::makeByArray($item_data),
                $data['reactions'],
            ),
        );
    }

    public function getRequestData(): array
    {
        return [
            'chat' => $this->chat,
            'message_id' => $this->message_id,
            'date' => $this->date,
            'reactions' => $this->reactions,
        ];
    }
}
