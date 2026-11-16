<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about a chat being joined by a user from a community.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CommunityChatJoined extends Type
{
    /**
     * @param Community $community The community from which the chat was joined
     */
    public function __construct(
        public Community $community,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            community: Community::makeByArray($data['community']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'community' => $this->community,
        ];
    }
}
