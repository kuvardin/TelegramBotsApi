<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\MessageOrigin;

use Kuvardin\TelegramBotsApi\Types\MessageOrigin;
use RuntimeException;

/**
 * The message was originally sent on behalf of a chat to a group chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Chat extends MessageOrigin
{
    /**
     * @param int $date Date the message was sent originally in Unix time
     * @param Chat $sender_chat Chat that sent the message originally
     * @param string|null $author_signature For messages originally sent by an anonymous chat administrator, original
     *     message author signature
     */
    public function __construct(
        public int $date,
        public Chat $sender_chat,
        public ?string $author_signature = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'chat';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong message origin type: {$data['type']}");
        }

        return new self(
            date: $data['date'],
            sender_chat: Chat::makeByArray($data['sender_chat']),
            author_signature: $data['author_signature'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'date' => $this->date,
            'sender_chat' => $this->sender_chat,
            'author_signature' => $this->author_signature,
        ];
    }
}