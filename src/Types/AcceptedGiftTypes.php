<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes the types of gifts that can be gifted to a user or a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class AcceptedGiftTypes extends Type
{
    /**
     * @param bool $unlimited_gifts True, if unlimited regular gifts are accepted
     * @param bool $limited_gifts True, if limited regular gifts are accepted
     * @param bool $unique_gifts True, if unique gifts or gifts that can be upgraded to unique for free are accepted
     * @param bool $premium_subscription True, if a Telegram Premium subscription is accepted
     * @param bool $gifts_from_channels True, if transfers of unique gifts from channels are accepted
     */
    public function __construct(
        public bool $unlimited_gifts,
        public bool $limited_gifts,
        public bool $unique_gifts,
        public bool $premium_subscription,
        public bool $gifts_from_channels,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            unlimited_gifts: $data['unlimited_gifts'],
            limited_gifts: $data['limited_gifts'],
            unique_gifts: $data['unique_gifts'],
            premium_subscription: $data['premium_subscription'],
            gifts_from_channels: $data['gifts_from_channels'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'unlimited_gifts' => $this->unlimited_gifts,
            'limited_gifts' => $this->limited_gifts,
            'unique_gifts' => $this->unique_gifts,
            'premium_subscription' => $this->premium_subscription,
            'gifts_from_channels' => $this->gifts_from_channels,
        ];
    }
}

