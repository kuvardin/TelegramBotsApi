<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ChatBoostSource;

use Kuvardin\TelegramBotsApi\Types\ChatBoostSource;
use Kuvardin\TelegramBotsApi\Types\User;
use RuntimeException;

/**
 * The boost was obtained by the creation of Telegram Premium gift codes to boost a chat. Each such code boosts the chat
 * 4 times for the duration of the corresponding Telegram Premium subscription.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GiftCode extends ChatBoostSource
{
    /**
     * @param User $user User for which the gift code was created
     */
    public function __construct(
        public User $user,
    )
    {

    }

    public static function getSource(): string
    {
        return 'gift_code';
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