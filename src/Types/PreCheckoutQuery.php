<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this class contains information about an incoming pre-checkout query.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class PreCheckoutQuery implements TypeInterface
{

    /**
     * @var string Unique query identifier
     */
    public $id;

    /**
     * @var User User who sent the query
     */
    public $from;

    /**
     * @var string Three-letter ISO 4217 currency code
     */
    public $currency;

    /**
     * @var int Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     */
    public $total_amount;

    /**
     * @var string Bot specified invoice payload
     */
    public $invoice_payload;

    /**
     * @var string|null Identifier of the shipping option chosen by the user
     */
    public $shipping_option_id;

    /**
     * @var OrderInfo|null Order info provided by the user
     */
    public $order_info;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->from = $data['from'] instanceof User ? $data['from'] : new User($data['from']);
        $this->currency = $data['currency'];
        $this->total_amount = $data['total_amount'];
        $this->invoice_payload = $data['invoice_payload'];
        $this->shipping_option_id = $data['shipping_option_id'] ?? null;

        if (isset($data['order_info'])) {
            $this->order_info = $data['order_info'] instanceof OrderInfo ? $data['order_info'] : new OrderInfo($data['order_info']);
        }
    }

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
}