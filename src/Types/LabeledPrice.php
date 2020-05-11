<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * This object represents a portion of the price for goods or services.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class LabeledPrice implements TypeInterface
{
    /**
     * @var string Portion label
     */
    public string $label;

    /**
     * @var int Price of the product in the smallest units of the currency (integer, not float/double).
     * For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json,
     * it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     */
    public int $amount;

    /**
     * LabeledPrice constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->label = $data['label'];
        $this->amount = $data['amount'];
    }

    /**
     * @param string $label Portion label
     * @param int $amount Price of the product in the smallest units of the currency (integer, not float/double).
     * For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json,
     * it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     * @return LabeledPrice
     */
    public static function make(string $label, int $amount): self
    {
        return new self([
            'label' => $label,
            'amount' => $amount,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'label' => $this->label,
            'amount' => $this->amount,
        ];
    }
}
