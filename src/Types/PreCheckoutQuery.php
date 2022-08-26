<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about an incoming pre-checkout query.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PreCheckoutQuery extends Type
{
    /**
     * @param string $id Unique query identifier
     * @param User $from User who sent the query
     * @param string $currency Three-letter ISO 4217 <a
     *     href="https://core.telegram.org/bots/payments#supported-currencies">currency</a> code
     * @param int $total_amount Total price in the <em>smallest units</em> of the currency (integer,
     *     <strong>not</strong> float/double). For example, for a price of <code>US$ 1.45</code> pass <code>amount =
     *     145</code>. See the <em>exp</em> parameter in <a
     *     href="https://core.telegram.org/bots/payments/currencies.json">currencies.json</a>, it shows the number of
     *     digits past the decimal point for each currency (2 for the majority of currencies).
     * @param string $invoice_payload Bot specified invoice payload
     * @param string|null $shipping_option_id Identifier of the shipping option chosen by the user
     * @param OrderInfo|null $order_info Order info provided by the user
     */
    public function __construct(
        public string $id,
        public User $from,
        public string $currency,
        public int $total_amount,
        public string $invoice_payload,
        public ?string $shipping_option_id = null,
        public ?OrderInfo $order_info = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            from: User::makeByArray($data['from']),
            currency: $data['currency'],
            total_amount: $data['total_amount'],
            invoice_payload: $data['invoice_payload'],
            shipping_option_id: $data['shipping_option_id'] ?? null,
            order_info: isset($data['order_info'])
                ? OrderInfo::makeByArray($data['order_info'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'from' => $this->from,
            'currency' => $this->currency,
            'total_amount' => $this->total_amount,
            'invoice_payload' => $this->invoice_payload,
            'shipping_option_id' => $this->shipping_option_id,
            'order_info' => $this->order_info,
        ];
    }
}
