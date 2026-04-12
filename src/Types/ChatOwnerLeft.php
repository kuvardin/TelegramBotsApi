<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about the chat owner leaving the chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatOwnerLeft extends Type
{
    /**
     * @param User|null $new_owner The user which will be the new owner of the chat if the previous owner does not
     *     return to the chat
     */
    public function __construct(
        public ?User $new_owner = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            new_owner: isset($data['new_owner'])
                ? User::makeByArray($data['new_owner'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'new_owner' => $this->new_owner,
        ];
    }
}
