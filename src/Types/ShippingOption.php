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
     * @var string $id Shipping option identifier
     */
    public string $id;

    /**
     * @var string $title Option title
     */
    public string $title;

    /**
     * @var LabeledPrice[] $prices List of price portions
     */
    public array $prices;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->id = $data['id'];
        $result->title = $data['title'];
        $result->prices = [];
        foreach ($data['prices'] as $item_data) {
            $result->prices[] = LabeledPrice::makeByArray($item_data);
        }
        return $result;
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
