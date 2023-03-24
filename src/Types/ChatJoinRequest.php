<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Represents a join request sent to a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatJoinRequest extends Type
{
    /**
     * @param Chat $chat Chat to which the request was sent
     * @param User $from User that sent the join request
     * @param int $user_chat_id Identifier of a private chat with the user who sent the join request. This number may
     *     have more than 32 significant bits and some programming languages may have difficulty/silent defects in
     *     interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type
     *     are safe for storing this identifier. The bot can use this identifier for 24 hours to send messages until
     *     the join request is processed, assuming no other administrator contacted the user.
     * @param int $date Date the request was sent in Unix time
     * @param string|null $bio Bio of the user.
     * @param ChatInviteLink|null $invite_link Chat invite link that was used by the user to send the join request
     */
    public function __construct(
        public Chat $chat,
        public User $from,
        public int $user_chat_id,
        public int $date,
        public ?string $bio = null,
        public ?ChatInviteLink $invite_link = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            chat: Chat::makeByArray($data['chat']),
            from: User::makeByArray($data['from']),
            user_chat_id: $data['user_chat_id'],
            date: $data['date'],
            bio: $data['bio'] ?? null,
            invite_link: isset($data['invite_link'])
                ? ChatInviteLink::makeByArray($data['invite_link'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'chat' => $this->chat,
            'from' => $this->from,
            'user_chat_id' => $this->user_chat_id,
            'date' => $this->date,
            'bio' => $this->bio,
            'invite_link' => $this->invite_link,
        ];
    }
}
