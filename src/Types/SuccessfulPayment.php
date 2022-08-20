<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains basic information about a successful payment.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SuccessfulPayment extends Type
{
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

    /**
     * @var string $invoice_payload Bot specified invoice payload
     */
    public string $invoice_payload;

    /**
     * @var string|null $shipping_option_id Identifier of the shipping option chosen by the user
     */
    public ?string $shipping_option_id = null;

    /**
     * @var OrderInfo|null $order_info Order info provided by the user
     */
    public ?OrderInfo $order_info = null;

    /**
     * @var string $telegram_payment_charge_id Telegram payment identifier
     */
    public string $telegram_payment_charge_id;

    /**
     * @var string $provider_payment_charge_id Provider payment identifier
     */
    public string $provider_payment_charge_id;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->currency = $data['currency'];
        $result->total_amount = $data['total_amount'];
        $result->invoice_payload = $data['invoice_payload'];
        $result->shipping_option_id = $data['shipping_option_id'] ?? null;
        $result->order_info = isset($data['order_info'])
            ? OrderInfo::makeByArray($data['order_info'])
            : null;
        $result->telegram_payment_charge_id = $data['telegram_payment_charge_id'];
        $result->provider_payment_charge_id = $data['provider_payment_charge_id'];
        return $result;
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
        ];
    }
}
