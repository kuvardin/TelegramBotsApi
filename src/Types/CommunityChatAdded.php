<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about a chat or a bot being added to a community.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CommunityChatAdded extends Type
{
    /**
     * @param Community $community The new community to which the chat or the bot belongs
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
