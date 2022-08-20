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
     * @var Chat $chat Chat to which the request was sent
     */
    public Chat $chat;

    /**
     * @var User $from User that sent the join request
     */
    public User $from;

    /**
     * @var int $date Date the request was sent in Unix time
     */
    public int $date;

    /**
     * @var string|null $bio Bio of the user.
     */
    public ?string $bio = null;

    /**
     * @var ChatInviteLink|null $invite_link Chat invite link that was used by the user to send the join request
     */
    public ?ChatInviteLink $invite_link = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->chat = Chat::makeByArray($data['chat']);
        $result->from = User::makeByArray($data['from']);
        $result->date = $data['date'];
        $result->bio = $data['bio'] ?? null;
        $result->invite_link = isset($data['invite_link'])
            ? ChatInviteLink::makeByArray($data['invite_link'])
            : null;
        return $result;
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
