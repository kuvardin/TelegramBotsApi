<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes the backdrop of a unique gift.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UniqueGiftBackdrop extends Type
{
    /**
     * @param string $name Name of the backdrop
     * @param UniqueGiftBackdropColors $colors Colors of the backdrop
     * @param int $rarity_per_mille The number of unique gifts that receive this backdrop for every 1000 gifts upgraded
     */
    public function __construct(
        public string $name,
        public UniqueGiftBackdropColors $colors,
        public int $rarity_per_mille,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            name: $data['name'],
            colors: UniqueGiftBackdropColors::makeByArray($data['colors']),
            rarity_per_mille: $data['rarity_per_mille'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'name' => $this->name,
            'colors' => $this->colors,
            'rarity_per_mille' => $this->rarity_per_mille,
        ];
    }
}
