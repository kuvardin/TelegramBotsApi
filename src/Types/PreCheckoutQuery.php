<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * This object contains information about an incoming pre-checkout query.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PreCheckoutQuery implements TypeInterface
{
    /**
     * @var string Unique query identifier
     */
    public string $id;

    /**
     * @var User User who sent the query
     */
    public User $from;

    /**
     * @var string Three-letter ISO 4217 currency code
     */
    public string $currency;

    /**
     * @var int Total price in the smallest units of the currency (integer, not float/double).
     * For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json,
     * it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     */
    public int $total_amount;

    /**
     * @var string Bot specified invoice payload
     */
    public string $invoice_payload;

    /**
     * @var string|null Identifier of the shipping option chosen by the user
     */
    public ?string $shipping_option_id = null;

    /**
     * @var OrderInfo|null Order info provided by the user
     */
    public ?OrderInfo $order_info = null;

    /**
     * PreCheckoutQuery constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->from = $data['from'] instanceof User
            ? $data['from']
            : new User($data['from']);
        $this->currency = $data['currency'];
        $this->total_amount = $data['total_amount'];
        $this->invoice_payload = $data['invoice_payload'];

        if (isset($data['shipping_option_id'])) {
            $this->shipping_option_id = $data['shipping_option_id'];
        }

        if (isset($data['order_info'])) {
            $this->order_info = $data['order_info'] instanceof OrderInfo
                ? $data['order_info']
                : new OrderInfo($data['order_info']);
        }
    }

    /**
     * @param string $id Unique query identifier
     * @param User $from User who sent the query
     * @param string $currency Three-letter ISO 4217 currency code
     * @param int $total_amount Total price in the smallest units of the currency (integer, not float/double).
     * For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json,
     * it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     * @param string $invoice_payload Bot specified invoice payload
     * @return PreCheckoutQuery
     */
    public static function make(string $id, User $from, string $currency, int $total_amount, string $invoice_payload): self
    {
        return new self([
            'id' => $id,
            'from' => $from,
            'currency' => $currency,
            'total_amount' => $total_amount,
            'invoice_payload' => $invoice_payload,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
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
