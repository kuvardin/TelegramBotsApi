<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains basic information about a successful payment. Note that if the buyer initiates a chargeback with
 * the relevant payment provider following this transaction, the funds may be debited from your balance. This is outside
 * of Telegram's control.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SuccessfulPayment extends Type
{
    /**
     * @param string $currency Three-letter ISO 4217 currency code, or “XTR” for payments in Telegram Stars
     * @param int $total_amount Total price in the smallest units of the currency (integer, not float/double). For
     *     example, for a price of "US$ 1.45" pass "amount = 145". See the exp parameter in currencies.json, it shows
     *     the number of digits past the decimal point for each currency (2 for the majority of currencies).
     * @param string $invoice_payload Bot specified invoice payload
     * @param string $telegram_payment_charge_id Telegram payment identifier
     * @param string $provider_payment_charge_id Provider payment identifier
     * @param string|null $shipping_option_id Identifier of the shipping option chosen by the user
     * @param OrderInfo|null $order_info Order information provided by the user
     * @param int|null $subscription_expiration_date Expiration date of the subscription, in Unix time;
     *     for recurring payments only
     * @param bool|null $is_recurring True, if the payment is a recurring payment for a subscription
     * @param bool|null $is_first_recurring True, if the payment is the first payment for a subscription
     */
    public function __construct(
        public string $currency,
        public int $total_amount,
        public string $invoice_payload,
        public string $telegram_payment_charge_id,
        public string $provider_payment_charge_id,
        public ?string $shipping_option_id = null,
        public ?OrderInfo $order_info = null,
        public ?int $subscription_expiration_date = null,
        public ?bool $is_recurring = null,
        public ?bool $is_first_recurring = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            currency: $data['currency'],
            total_amount: $data['total_amount'],
            invoice_payload: $data['invoice_payload'],
            telegram_payment_charge_id: $data['telegram_payment_charge_id'],
            provider_payment_charge_id: $data['provider_payment_charge_id'],
            shipping_option_id: $data['shipping_option_id'] ?? null,
            order_info: isset($data['order_info'])
                ? OrderInfo::makeByArray($data['order_info'])
                : null,
            subscription_expiration_date: $data['subscription_expiration_date'] ?? null,
            is_recurring: $data['is_recurring'] ?? null,
            is_first_recurring: $data['is_first_recurring'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'currency' => $this->currency,
            'total_amount' => $this->total_amount,
            'invoice_payload' => $this->invoice_payload,
            'shipping_option_id' => $this->shipping_option_id,
            'order_info' => $this->order_info,
            'telegram_payment_charge_id' => $this->telegram_payment_charge_id,
            'provider_payment_charge_id' => $this->provider_payment_charge_id,
            'subscription_expiration_date' => $this->subscription_expiration_date,
            'is_recurring' => $this->is_recurring,
            'is_first_recurring' => $this->is_first_recurring,
        ];
    }
}
