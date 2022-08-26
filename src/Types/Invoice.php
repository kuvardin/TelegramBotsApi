<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains basic information about an invoice.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Invoice extends Type
{
    /**
     * @param string $title Product name
     * @param string $description Product description
     * @param string $start_parameter Unique bot deep-linking parameter that can be used to generate this invoice
     * @param string $currency Three-letter ISO 4217 <a
     *     href="https://core.telegram.org/bots/payments#supported-currencies">currency</a> code
     * @param int $total_amount Total price in the <em>smallest units</em> of the currency (integer,
     *     <strong>not</strong> float/double). For example, for a price of <code>US$ 1.45</code> pass <code>amount =
     *     145</code>. See the <em>exp</em> parameter in <a
     *     href="https://core.telegram.org/bots/payments/currencies.json">currencies.json</a>, it shows the number of
     *     digits past the decimal point for each currency (2 for the majority of currencies).
     */
    public function __construct(
        public string $title,
        public string $description,
        public string $start_parameter,
        public string $currency,
        public int $total_amount,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            title: $data['title'],
            description: $data['description'],
            start_parameter: $data['start_parameter'],
            currency: $data['currency'],
            total_amount: $data['total_amount'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'start_parameter' => $this->start_parameter,
            'currency' => $this->currency,
            'total_amount' => $this->total_amount,
        ];
    }
}
