<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a gift that can be sent by the bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Gift extends Type
{
    /**
     * @param string $id Unique identifier of the gift
     * @param Sticker $sticker The sticker that represents the gift
     * @param int $star_count The number of Telegram Stars that must be paid to send the sticker
     * @param int|null $upgrade_star_count The number of Telegram Stars that must be paid to upgrade the gift to
     *     a unique one
     * @param int|null $total_count The total number of the gifts of this type that can be sent; for limited gifts only
     * @param int|null $remaining_count The number of remaining gifts of this type that can be sent; for limited gifts
     *     only
     */
    public function __construct(
        public string $id,
        public Sticker $sticker,
        public int $star_count,
        public ?int $upgrade_star_count = null,
        public ?int $total_count = null,
        public ?int $remaining_count = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            sticker: Sticker::makeByArray($data['sticker']),
            star_count: $data['star_count'],
            upgrade_star_count: $data['upgrade_star_count'] ?? null,
            total_count: $data['total_count'] ?? null,
            remaining_count: $data['remaining_count'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'sticker' => $this->sticker,
            'star_count' => $this->star_count,
            'upgrade_star_count' => $this->upgrade_star_count,
            'total_count' => $this->total_count,
            'remaining_count' => $this->remaining_count,
        ];
    }
}
