<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Enums\GiftModelRarity;
use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes the model of a unique gift.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UniqueGiftModel extends Type
{
    /**
     * @param string $name Name of the model
     * @param Sticker $sticker The sticker that represents the unique gift
     * @param int $rarity_per_mille The number of unique gifts that receive this model for every 1000 gift upgrades.
     *     Always 0 for crafted gifts.
     * @param GiftModelRarity|string|null $rarity_value Rarity of the model if it is a crafted model.
     */
    public function __construct(
        public string $name,
        public Sticker $sticker,
        public int $rarity_per_mille,
        public GiftModelRarity|string|null $rarity_value= null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            name: $data['name'],
            sticker: Sticker::makeByArray($data['sticker']),
            rarity_per_mille: $data['rarity_per_mille'],
            rarity_value: $data['rarity'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'name' => $this->name,
            'sticker' => $this->sticker,
            'rarity_per_mille' => $this->rarity_per_mille,
            'rarity' => $this->rarity_value,
        ];
    }

    public function getRarity(): ?GiftModelRarity
    {
        return is_string($this->rarity_value)
            ? GiftModelRarity::tryFrom($this->rarity_value)
            : $this->rarity_value;
    }
}
