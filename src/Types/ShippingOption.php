<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * This object represents one shipping option.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ShippingOption implements TypeInterface
{
    /**
     * @var string Shipping option identifier
     */
    public string $id;

    /**
     * @var string Option title
     */
    public string $title;

    /**
     * @var LabeledPrice[] List of price portions
     */
    public array $prices = [];

    /**
     * ShippingOption constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];

        foreach ($data['prices'] as $item) {
            $this->prices[] = $item instanceof LabeledPrice ? $item : new LabeledPrice($item);
        }
    }

    /**
     * @param string $id Shipping option identifier
     * @param string $title Option title
     * @param LabeledPrice[] $prices List of price portions
     * @return ShippingOption
     */
    public static function make(string $id, string $title, array $prices): self
    {
        return new self([
            'id' => $id,
            'title' => $title,
            'prices' => $prices,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'prices' => $this->prices,
        ];
    }
}