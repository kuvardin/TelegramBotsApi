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
     * @var string $title Product name
     */
    public string $title;

    /**
     * @var string $description Product description
     */
    public string $description;

    /**
     * @var string $start_parameter Unique bot deep-linking parameter that can be used to generate this invoice
     */
    public string $start_parameter;

    /**
     * @var string $currency Three-letter ISO 4217 <a
     *     href="https://core.telegram.org/bots/payments#supported-currencies">currency</a> code
     */
    public string $currency;

    /**
     * @var int $total_amount Total price in the <em>smallest units</em> of the currency (integer, <strong>not</strong>
     *     float/double). For example, for a price of <code>US$ 1.45</code> pass <code>amount = 145</code>. See the
     *     <em>exp</em> parameter in <a
     *     href="https://core.telegram.org/bots/payments/currencies.json">currencies.json</a>, it shows the number of
     *     digits past the decimal point for each currency (2 for the majority of currencies).
     */
    public int $total_amount;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->title = $data['title'];
        $result->description = $data['description'];
        $result->start_parameter = $data['start_parameter'];
        $result->currency = $data['currency'];
        $result->total_amount = $data['total_amount'];
        return $result;
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
