<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ChatMember;

use Kuvardin\TelegramBotsApi\Types\ChatMember;
use Kuvardin\TelegramBotsApi\Types\User;
use RuntimeException;

/**
 * Represents a <a href="https://core.telegram.org/bots/api#chatmember">chat member</a> that owns the chat and has all
 * administrator privileges.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Owner extends ChatMember
{
    /**
     * @param User $user Information about the user
     * @param bool $is_anonymous True, if the user's presence in the chat is hidden
     * @param string|null $custom_title Custom title for this user
     */
    public function __construct(
        public User $user,
        public bool $is_anonymous,
        public ?string $custom_title = null,
    )
    {

    }

    public static function getStatus(): string
    {
        return 'creator';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['status'] !== self::getStatus()) {
            throw new RuntimeException("Wrong chat member status: {$data['status']}");
        }

        return new self(
            user: User::makeByArray($data['user']),
            is_anonymous: $data['is_anonymous'],
            custom_title: $data['custom_title'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'status' => self::getStatus(),
            'user' => $this->user,
            'is_anonymous' => $this->is_anonymous,
            'custom_title' => $this->custom_title,
        ];
    }
}
