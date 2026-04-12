<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes the symbol shown on the pattern of a unique gift.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UniqueGiftSymbol extends Type
{
    /**
     * @param string $name Name of the symbol
     * @param Sticker $sticker The sticker that represents the unique gift
     * @param int $rarity_per_mille The number of unique gifts that receive this model for every 1000 gifts upgraded
     */
    public function __construct(
        public string $name,
        public Sticker $sticker,
        public int $rarity_per_mille,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            name: $data['name'],
            sticker: Sticker::makeByArray($data['sticker']),
            rarity_per_mille: $data['rarity_per_mille'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'name' => $this->name,
            'sticker' => $this->sticker,
            'rarity_per_mille' => $this->rarity_per_mille,
        ];
    }
}
