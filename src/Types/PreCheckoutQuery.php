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
     * @param string $currency Three-letter ISO 4217 currency code, or “XTR” for payments in Telegram Stars
     * @param int $total_amount Total price in the smallest units of the currency (integer, not float/double). For
     *     example, for a price of "US$ 1.45" pass "amount = 145". See the exp parameter in currencies.json, it shows
     *     the number of digits past the decimal point for each currency (2 for the majority of currencies).
     * @param string $invoice_payload Bot specified invoice payload
     * @param string|null $shipping_option_id Identifier of the shipping option chosen by the user
     * @param OrderInfo|null $order_info Order information provided by the user
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
