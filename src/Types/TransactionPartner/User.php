<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\TransactionPartner;

use Kuvardin\TelegramBotsApi\Types\TransactionPartner;
use RuntimeException;

/**
 * Describes a transaction with a user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class User extends TransactionPartner
{
    /**
     * @param User $user Information about the user
     */
    public function __construct(
        public User $user,
    )
    {

    }

    public static function getType(): string
    {
        return 'user';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong transaction partner type: {$data['type']}");
        }

        return new self(
            user: User::makeByArray($data['user']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'user' => $this->user,
        ];
    }
}
