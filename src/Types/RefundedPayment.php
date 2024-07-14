<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains basic information about a refunded payment.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RefundedPayment extends Type
{
    /**
     * @param string $currency Three-letter ISO 4217 currency code, or “XTR” for payments in Telegram Stars. Currently,
     *     always “XTR”
     * @param int $total_amount Total refunded price in the "smallest units" of the currency (integer, not
     *     float/double). For example, for a price of "US$ 1.45", "total_amount = 145". See the "exp" parameter in
     *     currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority
     *     of currencies).
     * @param string $invoice_payload Bot-specified invoice payload
     * @param string $telegram_payment_charge_id Telegram payment identifier
     * @param string|null $provider_payment_charge_id Provider payment identifier
     */
    public function __construct(
        public string $currency,
        public int $total_amount,
        public string $invoice_payload,
        public string $telegram_payment_charge_id,
        public ?string $provider_payment_charge_id = null,
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
            provider_payment_charge_id: $data['provider_payment_charge_id'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'currency' => $this->currency,
            'total_amount' => $this->total_amount,
            'invoice_payload' => $this->invoice_payload,
            'telegram_payment_charge_id' => $this->telegram_payment_charge_id,
            'provider_payment_charge_id' => $this->provider_payment_charge_id,
        ];
    }
}
