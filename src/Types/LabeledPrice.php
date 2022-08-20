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
     * @var string $label Portion label
     */
    public string $label;

    /**
     * @var int $amount Price of the product in the <em>smallest units</em> of the <a
     *     href="https://core.telegram.org/bots/payments#supported-currencies">currency</a> (integer,
     *     <strong>not</strong> float/double). For example, for a price of <code>US$ 1.45</code> pass <code>amount =
     *     145</code>. See the <em>exp</em> parameter in <a
     *     href="https://core.telegram.org/bots/payments/currencies.json">currencies.json</a>, it shows the number of
     *     digits past the decimal point for each currency (2 for the majority of currencies).
     */
    public int $amount;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->label = $data['label'];
        $result->amount = $data['amount'];
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'label' => $this->label,
            'amount' => $this->amount,
        ];
    }
}
