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
     * @param int|null $upgrade_star_count The number of Telegram Stars that must be paid to upgrade the gift to a
     *     unique one
     * @param int|null $total_count The total number of gifts of this type that can be sent by all users; for limited
     *     gifts only
     * @param int|null $remaining_count The number of remaining gifts of this type that can be sent by all users; for
     *     limited gifts only
     * @param bool|null $is_premium True, if the gift can only be purchased by Telegram Premium subscribers
     * @param bool|null $has_colors True, if the gift can be used (after being upgraded) to customize a user's
     *     appearance
     * @param int|null $personal_total_count The total number of gifts of this type that can be sent by the bot; for
     *     limited gifts only
     * @param int|null $personal_remaining_count The number of remaining gifts of this type that can be sent by the
     *     bot; for limited gifts only
     * @param GiftBackground|null $background Background of the gift
     * @param int|null $unique_gift_variant_count The total number of different unique gifts that can be obtained by
     *     upgrading the gift
     * @param Chat|null $publisher_chat Information about the chat that published the gift
     */
    public function __construct(
        public string $id,
        public Sticker $sticker,
        public int $star_count,
        public ?int $upgrade_star_count = null,
        public ?int $total_count = null,
        public ?int $remaining_count = null,
        public ?bool $is_premium = null,
        public ?bool $has_colors = null,
        public ?int $personal_total_count = null,
        public ?int $personal_remaining_count = null,
        public ?GiftBackground $background = null,
        public ?int $unique_gift_variant_count = null,
        public ?Chat $publisher_chat = null,
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
            is_premium: $data['is_premium'] ?? null,
            has_colors: $data['has_colors'] ?? null,
            personal_total_count: $data['personal_total_count'] ?? null,
            personal_remaining_count: $data['personal_remaining_count'] ?? null,
            background: isset($data['background'])
                ? GiftBackground::makeByArray($data['background'])
                : null,
            unique_gift_variant_count: $data['unique_gift_variant_count'] ?? null,
            publisher_chat: isset($data['publisher_chat'])
                ? Chat::makeByArray($data['publisher_chat'])
                : null,
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
            'is_premium' => $this->is_premium,
            'has_colors' => $this->has_colors,
            'personal_total_count' => $this->personal_total_count,
            'personal_remaining_count' => $this->personal_remaining_count,
            'background' => $this->background,
            'unique_gift_variant_count' => $this->unique_gift_variant_count,
            'publisher_chat' => $this->publisher_chat,
        ];
    }
}
