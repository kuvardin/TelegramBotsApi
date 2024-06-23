<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMessageContent;

use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use Kuvardin\TelegramBotsApi\Types\LabeledPrice;

/**
 * Represents the <a href="https://core.telegram.org/bots/api#inputmessagecontent">content</a> of an invoice message to
 * be sent as the result of an inline query.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Invoice extends InputMessageContent
{
    /**
     * @param string $title Product name, 1-32 characters
     * @param string $description Product description, 1-255 characters
     * @param string $payload Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for
     *     your internal processes.
     * @param string $currency Three-letter ISO 4217 currency code, see . Pass “XTR” for payments in Telegram Stars.
     * @param LabeledPrice[] $prices Price breakdown, a JSON-serialized list of components (e.g. product price, tax,
     *     discount, delivery cost, delivery tax, bonus, etc.). Must contain exactly one item for payments in Telegram
     *     Stars.
     * @param string|null $provider_token Payment provider token, obtained via &#64;BotFather. Pass an empty string for
     *     payments in Telegram Stars.
     * @param int|null $max_tip_amount The maximum accepted amount for tips in the smallest units of the currency
     *     (integer, not float/double). For example, for a maximum tip of "US$ 1.45" pass "max_tip_amount = 145". See
     *     the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency
     *     (2 for the majority of currencies). Defaults to 0. Not supported for payments in Telegram Stars.
     * @param int[]|null $suggested_tip_amounts A JSON-serialized array of suggested amounts of tip in the smallest
     *     units of the currency (integer, not float/double). At most 4 suggested tip amounts can be specified. The
     *     suggested tip amounts must be positive, passed in a strictly increased order and must not exceed
     *     max_tip_amount.
     * @param string|null $provider_data A JSON-serialized object for data about the invoice, which will be shared with
     *     the payment provider. A detailed description of the required fields should be provided by the payment
     *     provider.
     * @param string|null $photo_url URL of the product photo for the invoice. Can be a photo of the goods or a
     *     marketing image for a service.
     * @param int|null $photo_size Photo size in bytes
     * @param int|null $photo_width Photo width
     * @param int|null $photo_height Photo height
     * @param bool|null $need_name Pass True if you require the user's full name to complete the order. Ignored for
     *     payments in Telegram Stars.
     * @param bool|null $need_phone_number Pass True if you require the user's phone number to complete the order.
     *     Ignored for payments in Telegram Stars.
     * @param bool|null $need_email Pass True if you require the user's email address to complete the order. Ignored
     *     for payments in Telegram Stars.
     * @param bool|null $need_shipping_address Pass True if you require the user's shipping address to complete the
     *     order. Ignored for payments in Telegram Stars.
     * @param bool|null $send_phone_number_to_provider Pass True if the user's phone number should be sent to the
     *     provider. Ignored for payments in Telegram Stars.
     * @param bool|null $send_email_to_provider Pass True if the user's email address should be sent to the provider.
     *     Ignored for payments in Telegram Stars.
     * @param bool|null $is_flexible Pass True if the final price depends on the shipping method. Ignored for payments
     *     in Telegram Stars.
     */
    public function __construct(
        public string $title,
        public string $description,
        public string $payload,
        public string $currency,
        public array $prices,
        public ?string $provider_token = null,
        public ?int $max_tip_amount = null,
        public ?array $suggested_tip_amounts = null,
        public ?string $provider_data = null,
        public ?string $photo_url = null,
        public ?int $photo_size = null,
        public ?int $photo_width = null,
        public ?int $photo_height = null,
        public ?bool $need_name = null,
        public ?bool $need_phone_number = null,
        public ?bool $need_email = null,
        public ?bool $need_shipping_address = null,
        public ?bool $send_phone_number_to_provider = null,
        public ?bool $send_email_to_provider = null,
        public ?bool $is_flexible = null,
    )
    {

    }

    public static function makeByArray(array $data): static
    {
        return new self(
            title: $data['title'],
            description: $data['description'],
            payload: $data['payload'],
            currency: $data['currency'],
            prices: array_map(
                static fn(array $prices_data) => LabeledPrice::makeByArray($prices_data),
                $data['prices'],
            ),
            provider_token: $data['provider_token'] ?? null,
            max_tip_amount: $data['max_tip_amount'] ?? null,
            suggested_tip_amounts: $data['suggested_tip_amounts'] ?? null,
            provider_data: $data['provider_data'] ?? null,
            photo_url: $data['photo_url'] ?? null,
            photo_size: $data['photo_size'] ?? null,
            photo_width: $data['photo_width'] ?? null,
            photo_height: $data['photo_height'] ?? null,
            need_name: $data['need_name'] ?? null,
            need_phone_number: $data['need_phone_number'] ?? null,
            need_email: $data['need_email'] ?? null,
            need_shipping_address: $data['need_shipping_address'] ?? null,
            send_phone_number_to_provider: $data['send_phone_number_to_provider'] ?? null,
            send_email_to_provider: $data['send_email_to_provider'] ?? null,
            is_flexible: $data['is_flexible'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'payload' => $this->payload,
            'provider_token' => $this->provider_token,
            'currency' => $this->currency,
            'prices' => $this->prices,
            'max_tip_amount' => $this->max_tip_amount,
            'suggested_tip_amounts' => $this->suggested_tip_amounts,
            'provider_data' => $this->provider_data,
            'photo_url' => $this->photo_url,
            'photo_size' => $this->photo_size,
            'photo_width' => $this->photo_width,
            'photo_height' => $this->photo_height,
            'need_name' => $this->need_name,
            'need_phone_number' => $this->need_phone_number,
            'need_email' => $this->need_email,
            'need_shipping_address' => $this->need_shipping_address,
            'send_phone_number_to_provider' => $this->send_phone_number_to_provider,
            'send_email_to_provider' => $this->send_email_to_provider,
            'is_flexible' => $this->is_flexible,
        ];
    }
}
