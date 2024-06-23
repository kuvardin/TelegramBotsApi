<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a service message about new members invited to a video chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class VideoChatParticipantsInvited extends Type
{
    /**
     * @param User[] $users New members that were invited to the video chat
     */
    public function __construct(
        public array $users,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            users: array_map(
                static fn(array $users_data) => User::makeByArray($users_data),
                $data['users'],
            ),
        );
    }

    public function getRequestData(): array
    {
        return [
            'users' => $this->users,
        ];
    }
}
