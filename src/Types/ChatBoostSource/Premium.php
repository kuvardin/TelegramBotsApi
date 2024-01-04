<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ChatBoostSource;

use Kuvardin\TelegramBotsApi\Types\ChatBoostSource;
use Kuvardin\TelegramBotsApi\Types\User;
use RuntimeException;

/**
 * The boost was obtained by subscribing to Telegram Premium or by gifting a Telegram Premium subscription to another
 * user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Premium extends ChatBoostSource
{
    /**
     * @param User $user User that boosted the chat
     */
    public function __construct(
        public User $user,
    )
    {

    }

    public static function getSource(): string
    {
        return 'premium';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['source'] !== self::getSource()) {
            throw new RuntimeException("Wrong chat boost source: {$data['source']}");
        }

        return new self(
            user: User::makeByArray($data['user']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'source' => self::getSource(),
            'user' => $this->user,
        ];
    }
}