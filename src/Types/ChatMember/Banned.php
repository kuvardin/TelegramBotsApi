<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ChatMember;

use Kuvardin\TelegramBotsApi\Types\ChatMember;
use Kuvardin\TelegramBotsApi\Types\User;
use RuntimeException;

/**
 * Represents a <a href="https://core.telegram.org/bots/api#chatmember">chat member</a> that was banned in the chat and
 * can't return to the chat or view chat messages.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Banned extends ChatMember
{
    /**
     * @param User $user Information about the user
     * @param int $until_date Date when restrictions will be lifted for this user; unix time. If 0, then the user is
     *     banned forever
     */
    public function __construct(
        public User $user,
        public int $until_date,
    )
    {

    }

    public static function getStatus(): string
    {
        return 'kicked';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['status'] !== self::getStatus()) {
            throw new RuntimeException("Wrong chat member status: {$data['status']}");
        }

        return new self(
            user: User::makeByArray($data['user']),
            until_date: $data['until_date'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'status' => self::getStatus(),
            'user' => $this->user,
            'until_date' => $this->until_date,
        ];
    }
}
