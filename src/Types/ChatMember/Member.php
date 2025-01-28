<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ChatMember;

use Kuvardin\TelegramBotsApi\Types\ChatMember;
use Kuvardin\TelegramBotsApi\Types\User;
use RuntimeException;

/**
 * Represents a <a href="https://core.telegram.org/bots/api#chatmember">chat member</a> that has no additional
 * privileges or restrictions.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Member extends ChatMember
{
    /**
     * @param User $user Information about the user
     * @param int|null $until_date Date when the user's subscription will expire; Unix time
     */
    public function __construct(
        public User $user,
        public ?int $until_date = null,
    )
    {

    }

    public static function getStatus(): string
    {
        return 'member';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['status'] !== self::getStatus()) {
            throw new RuntimeException("Wrong chat member status: {$data['status']}");
        }

        return new self(
            user: User::makeByArray($data['user']),
            until_date: $data['until_date'] ?? null,
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
