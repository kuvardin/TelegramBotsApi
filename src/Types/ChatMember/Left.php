<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ChatMember;

use Kuvardin\TelegramBotsApi\Types\ChatMember;
use Kuvardin\TelegramBotsApi\Types\User;
use RuntimeException;

/**
 * Represents a <a href="https://core.telegram.org/bots/api#chatmember">chat member</a> that isn't currently a
 * member of the chat, but may join it themselves.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Left extends ChatMember
{
    /**
     * @param User $user Information about the user
     */
    public function __construct(
        public User $user,
    )
    {

    }

    public static function getStatus(): string
    {
        return 'left';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['status'] !== self::getStatus()) {
            throw new RuntimeException("Wrong chat member status: {$data['status']}");
        }

        return new self(
            user: User::makeByArray($data['user']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'status' => self::getStatus(),
            'user' => $this->user,
        ];
    }
}
