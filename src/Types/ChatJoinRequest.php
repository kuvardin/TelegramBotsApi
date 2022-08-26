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
     * @param int $date Date the request was sent in Unix time
     * @param string|null $bio Bio of the user.
     * @param ChatInviteLink|null $invite_link Chat invite link that was used by the user to send the join request
     */
    public function __construct(
        public Chat $chat,
        public User $from,
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
            'date' => $this->date,
            'bio' => $this->bio,
            'invite_link' => $this->invite_link,
        ];
    }
}
