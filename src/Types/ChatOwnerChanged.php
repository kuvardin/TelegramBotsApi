<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about an ownership change in the chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatOwnerChanged extends Type
{
    /**
     * @param User $new_owner The new owner of the chat
     */
    public function __construct(
        public User $new_owner,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            new_owner: User::makeByArray($data['new_owner']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'new_owner' => $this->new_owner,
        ];
    }
}
