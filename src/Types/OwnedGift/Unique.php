<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\OwnedGift;

use Kuvardin\TelegramBotsApi\Types\OwnedGift;
use Kuvardin\TelegramBotsApi\Types\UniqueGift;
use Kuvardin\TelegramBotsApi\Types\User;
use RuntimeException;

/**
 * Describes a unique gift received and owned by a user or a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Unique extends OwnedGift
{
    /**
     * @param UniqueGift $gift Information about the unique gift
     * @param int $send_date Date the gift was sent in Unix time
     * @param string|null $owned_gift_id Unique identifier of the received gift for the bot; for gifts received on
     *     behalf of business accounts only
     * @param User|null $sender_user Sender of the gift if it is a known user
     * @param bool|null $is_saved True, if the gift is displayed on the account's profile page; for gifts received on
     *     behalf of business accounts only
     * @param bool|null $can_be_transferred True, if the gift can be transferred to another owner; for gifts received on
     *     behalf of business accounts only
     * @param int|null $transfer_star_count Number of Telegram Stars that must be paid to transfer the gift; omitted if
     *     the bot cannot transfer the gift
     * @param int|null $next_transfer_date Point in time (Unix timestamp) when the gift can be transferred. If it is in
     *     the past, then the gift can be transferred now
     */
    public function __construct(
        public UniqueGift $gift,
        public int $send_date,
        public ?string $owned_gift_id = null,
        public ?User $sender_user = null,
        public ?bool $is_saved = null,
        public ?bool $can_be_transferred = null,
        public ?int $transfer_star_count = null,
        public ?int $next_transfer_date = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'unique';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong owned gift type: {$data['type']}");
        }

        return new self(
            gift: UniqueGift::makeByArray($data['gift']),
            send_date: $data['send_date'],
            owned_gift_id: $data['owned_gift_id'] ?? null,
            sender_user: isset($data['sender_user'])
                ? User::makeByArray($data['sender_user'])
                : null,
            is_saved: $data['is_saved'] ?? null,
            can_be_transferred: $data['can_be_transferred'] ?? null,
            transfer_star_count: $data['transfer_star_count'] ?? null,
            next_transfer_date: $data['next_transfer_date'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'gift' => $this->gift,
            'send_date' => $this->send_date,
            'owned_gift_id' => $this->owned_gift_id,
            'sender_user' => $this->sender_user,
            'is_saved' => $this->is_saved,
            'can_be_transferred' => $this->can_be_transferred,
            'transfer_star_count' => $this->transfer_star_count,
            'next_transfer_date' => $this->next_transfer_date,
        ];
    }
}
