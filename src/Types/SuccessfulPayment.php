<?php

declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * This object contains basic information about a successful payment.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SuccessfulPayment implements TypeInterface
{
    /**
     * @var string Three-letter ISO 4217 currency code
     */
    public string $currency;

    /**
     * @var int Total price in the smallest units of the currency (integer, not float/double). For example,
     * for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number
     * of digits past the decimal point for each currency (2 for the majority of currencies).
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
     * @var string Telegram payment identifier
     */
    public string $telegram_payment_charge_id;

    /**
     * @var string Provider payment identifier
     */
    public string $provider_payment_charge_id;

    /**
     * SuccessfulPayment constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
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

        $this->telegram_payment_charge_id = $data['telegram_payment_charge_id'];
        $this->provider_payment_charge_id = $data['provider_payment_charge_id'];
    }

    /**
     * @param string $currency Three-letter ISO 4217 currency code
     * @param int $total_amount Total price in the smallest units of the currency (integer, not float/double).
     * For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it
     * shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     * @param string $invoice_payload Bot specified invoice payload
     * @param string $telegram_payment_charge_id Telegram payment identifier
     * @param string $provider_payment_charge_id Provider payment identifier
     * @return SuccessfulPayment
     */
    public static function make(string $currency, int $total_amount, string $invoice_payload, string $telegram_payment_charge_id, string $provider_payment_charge_id): self
    {
        return new self([
            'currency' => $currency,
            'total_amount' => $total_amount,
            'invoice_payload' => $invoice_payload,
            'telegram_payment_charge_id' => $telegram_payment_charge_id,
            'provider_payment_charge_id' => $provider_payment_charge_id,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'currency' => $this->currency,
            'total_amount' => $this->total_amount,
            'invoice_payload' => $this->invoice_payload,
            'shipping_option_id' => $this->shipping_option_id,
            'order_info' => $this->order_info,
            'telegram_payment_charge_id' => $this->telegram_payment_charge_id,
            'provider_payment_charge_id' => $this->provider_payment_charge_id,
        ];
    }
}
