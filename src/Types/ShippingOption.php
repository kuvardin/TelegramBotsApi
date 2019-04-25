<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this class represents one shipping option.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class ShippingOption implements TypeInterface
{
    /**
     * @var string Shipping option identifier
     */
    public $id;

    /**
     * @var string Option title
     */
    public $title;

    /**
     * @var LabeledPrice[] List of price portions
     */
    public $prices;

    /**
     * ShippingOption constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->prices = [];
        foreach ($data['prices'] as $price) {
            $this->prices[] = $price instanceof LabeledPrice ? $price : new LabeledPrice($price);
        }
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

    /**
     * @param string $id
     * @param string $title
     * @param array $prices
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

}