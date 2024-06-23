<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a portion of the price for goods or services.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class LabeledPrice extends Type
{
    /**
     * @param string $label Portion label
     * @param int $amount Price of the product in the smallest units of the <a
     *     href="https://core.telegram.org/bots/payments#supported-currencies">currency</a> (integer,
     *     not float/double). For example, for a price of "US$ 1.45" pass <code>amount =
     *     145</code>. See the exp parameter in <a
     *     href="https://core.telegram.org/bots/payments/currencies.json">currencies.json</a>, it shows the number of
     *     digits past the decimal point for each currency (2 for the majority of currencies).
     */
    public function __construct(
        public string $label,
        public int $amount,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            label: $data['label'],
            amount: $data['amount'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'label' => $this->label,
            'amount' => $this->amount,
        ];
    }
}
