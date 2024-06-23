<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents one shipping option.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ShippingOption extends Type
{
    /**
     * @param string $id Shipping option identifier
     * @param string $title Option title
     * @param LabeledPrice[] $prices List of price portions
     */
    public function __construct(
        public string $id,
        public string $title,
        public array $prices,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            title: $data['title'],
            prices: array_map(
                static fn(array $prices_data) => LabeledPrice::makeByArray($prices_data),
                $data['prices'],
            ),
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'prices' => $this->prices,
        ];
    }
}
