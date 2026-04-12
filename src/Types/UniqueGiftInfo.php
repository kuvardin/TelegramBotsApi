<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about a unique gift that was sent or received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UniqueGiftInfo extends Type
{
    /**
     * @param UniqueGift $gift Information about the gift
     * @param string $origin Origin of the gift. Currently, either “upgrade” for gifts upgraded from regular gifts,
     *     “transfer” for gifts transferred from other users or channels, “resale” for gifts bought from other users,
     *     “gifted_upgrade” for upgrades purchased after the gift was sent, or “offer” for gifts bought or sold through
     *     gift purchase offers
     * @param string|null $last_resale_currency For gifts bought from other users, the currency in which the payment for
     *     the gift was done. Currently, one of “XTR” for Telegram Stars or “TON” for toncoins.
     * @param int|null $last_resale_amount For gifts bought from other users, the price paid for the gift in either
     *     Telegram Stars or nanotoncoins
     * @param string|null $owned_gift_id Unique identifier of the received gift for the bot; only present for gifts
     *     received on behalf of business accounts
     * @param int|null $transfer_star_count Number of Telegram Stars that must be paid to transfer the gift; omitted if
     *     the bot cannot transfer the gift
     * @param int|null $next_transfer_date Point in time (Unix timestamp) when the gift can be transferred. If it is in
     *     the past, then the gift can be transferred now
     */
    public function __construct(
        public UniqueGift $gift,
        public string $origin,
        public ?string $last_resale_currency = null,
        public ?int $last_resale_amount = null,
        public ?string $owned_gift_id = null,
        public ?int $transfer_star_count = null,
        public ?int $next_transfer_date = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            gift: UniqueGift::makeByArray($data['gift']),
            origin: $data['origin'],
            last_resale_currency: $data['last_resale_currency'] ?? null,
            last_resale_amount: $data['last_resale_amount'] ?? null,
            owned_gift_id: $data['owned_gift_id'] ?? null,
            transfer_star_count: $data['transfer_star_count'] ?? null,
            next_transfer_date: $data['next_transfer_date'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'gift' => $this->gift,
            'origin' => $this->origin,
            'last_resale_currency' => $this->last_resale_currency,
            'last_resale_amount' => $this->last_resale_amount,
            'owned_gift_id' => $this->owned_gift_id,
            'transfer_star_count' => $this->transfer_star_count,
            'next_transfer_date' => $this->next_transfer_date,
        ];
    }
}
