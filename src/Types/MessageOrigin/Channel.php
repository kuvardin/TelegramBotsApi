<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\MessageOrigin;

use Kuvardin\TelegramBotsApi\Types\Chat as TelegramChat;
use Kuvardin\TelegramBotsApi\Types\MessageOrigin;
use RuntimeException;

/**
 * The message was originally sent to a channel chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Channel extends MessageOrigin
{
    /**
     * @param int $date Date the message was sent originally in Unix time
     * @param TelegramChat $chat Channel chat to which the message was originally sent
     * @param int $message_id Unique message identifier inside the chat
     * @param string|null $author_signature Signature of the original post author
     */
    public function __construct(
        public int $date,
        public TelegramChat $chat,
        public int $message_id,
        public ?string $author_signature = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'channel';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong message origin type: {$data['type']}");
        }

        return new self(
            date: $data['date'],
            chat: TelegramChat::makeByArray($data['chat']),
            message_id: $data['message_id'],
            author_signature: $data['author_signature'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'date' => $this->date,
            'chat' => $this->chat,
            'message_id' => $this->message_id,
            'author_signature' => $this->author_signature,
        ];
    }
}