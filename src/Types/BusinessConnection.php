<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes the connection of the bot with a business account.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BusinessConnection extends Type
{
    /**
     * @param string $id Unique identifier of the business connection
     * @param User $user Business account user that created the business connection
     * @param int $user_chat_id Identifier of a private chat with the user who created the business connection.
     *     This number may have more than 32 significant bits and some programming languages may have difficulty/silent
     *     defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision
     *     float type are safe for storing this identifier.
     * @param int $date Date the connection was established in Unix time
     * @param bool $can_reply True, if the bot can act on behalf of the business account in chats that were active
     *     in the last 24 hours
     * @param bool $is_enabled True, if the connection is active
     */
    public function __construct(
        public string $id,
        public User $user,
        public int $user_chat_id,
        public int $date,
        public bool $can_reply,
        public bool $is_enabled,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            user: User::makeByArray($data['user']),
            user_chat_id: $data['user_chat_id'],
            date: $data['date'],
            can_reply: $data['can_reply'],
            is_enabled: $data['is_enabled'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user,
            'user_chat_id' => $this->user_chat_id,
            'date' => $this->date,
            'can_reply' => $this->can_reply,
            'is_enabled' => $this->is_enabled,
        ];
    }
}
