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
     * @var string $title Product name, 1-32 characters
     */
    public string $title;

    /**
     * @var string $description Product description, 1-255 characters
     */
    public string $description;

    /**
     * @var string $payload Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for
     *     your internal processes.
     */
    public string $payload;

    /**
     * @var string $provider_token Payment provider token, obtained via <a href="https://t.me/botfather">Botfather</a>
     */
    public string $provider_token;

    /**
     * @var string $currency Three-letter ISO 4217 currency code, see <a
     *     href="https://core.telegram.org/bots/payments#supported-currencies">more on currencies</a>
     */
    public string $currency;

    /**
     * @var LabeledPrice[] $prices Price breakdown, a JSON-serialized list of components (e.g. product price, tax,
     *     discount, delivery cost, delivery tax, bonus, etc.)
     */
    public array $prices;

    /**
     * @var int|null $max_tip_amount The maximum accepted amount for tips in the <em>smallest units</em> of the
     *     currency (integer, <strong>not</strong> float/double). For example, for a maximum tip of <code>US$
     *     1.45</code> pass <code>max_tip_amount = 145</code>. See the <em>exp</em> parameter in <a
     *     href="https://core.telegram.org/bots/payments/currencies.json">currencies.json</a>, it shows the number of
     *     digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0
     */
    public ?int $max_tip_amount = null;

    /**
     * @var int[]|null $suggested_tip_amounts A JSON-serialized array of suggested amounts of tip in the <em>smallest
     *     units</em> of the currency (integer, <strong>not</strong> float/double). At most 4 suggested tip amounts can
     *     be specified. The suggested tip amounts must be positive, passed in a strictly increased order and must not
     *     exceed <em>max_tip_amount</em>.
     */
    public ?array $suggested_tip_amounts = null;

    /**
     * @var string|null $provider_data A JSON-serialized object for data about the invoice, which will be shared with
     *     the payment provider. A detailed description of the required fields should be provided by the payment
     *     provider.
     */
    public ?string $provider_data = null;

    /**
     * @var string|null $photo_url URL of the product photo for the invoice. Can be a photo of the goods or a marketing
     *     image for a service. People like it better when they see what they are paying for.
     */
    public ?string $photo_url = null;

    /**
     * @var int|null $photo_size Photo size
     */
    public ?int $photo_size = null;

    /**
     * @var int|null $photo_width Photo width
     */
    public ?int $photo_width = null;

    /**
     * @var int|null $photo_height Photo height
     */
    public ?int $photo_height = null;

    /**
     * @var bool|null $need_name Pass <em>True</em>, if you require the user's full name to complete the order
     */
    public ?bool $need_name = null;

    /**
     * @var bool|null $need_phone_number Pass <em>True</em>, if you require the user's phone number to complete the
     *     order
     */
    public ?bool $need_phone_number = null;

    /**
     * @var bool|null $need_email Pass <em>True</em>, if you require the user's email address to complete the order
     */
    public ?bool $need_email = null;

    /**
     * @var bool|null $need_shipping_address Pass <em>True</em>, if you require the user's shipping address to complete
     *     the order
     */
    public ?bool $need_shipping_address = null;

    /**
     * @var bool|null $send_phone_number_to_provider Pass <em>True</em>, if user's phone number should be sent to
     *     provider
     */
    public ?bool $send_phone_number_to_provider = null;

    /**
     * @var bool|null $send_email_to_provider Pass <em>True</em>, if user's email address should be sent to provider
     */
    public ?bool $send_email_to_provider = null;

    /**
     * @var bool|null $is_flexible Pass <em>True</em>, if the final price depends on the shipping method
     */
    public ?bool $is_flexible = null;

    public static function makeByArray(array $data): static
    {
        $result = new self;
        $result->title = $data['title'];
        $result->description = $data['description'];
        $result->payload = $data['payload'];
        $result->provider_token = $data['provider_token'];
        $result->currency = $data['currency'];
        $result->prices = [];
        foreach ($data['prices'] as $item_data) {
            $result->prices[] = LabeledPrice::makeByArray($item_data);
        }
        $result->max_tip_amount = $data['max_tip_amount'] ?? null;
        $result->suggested_tip_amounts = $data['suggested_tip_amounts'] ?? null;
        $result->provider_data = $data['provider_data'] ?? null;
        $result->photo_url = $data['photo_url'] ?? null;
        $result->photo_size = $data['photo_size'] ?? null;
        $result->photo_width = $data['photo_width'] ?? null;
        $result->photo_height = $data['photo_height'] ?? null;
        $result->need_name = $data['need_name'] ?? null;
        $result->need_phone_number = $data['need_phone_number'] ?? null;
        $result->need_email = $data['need_email'] ?? null;
        $result->need_shipping_address = $data['need_shipping_address'] ?? null;
        $result->send_phone_number_to_provider = $data['send_phone_number_to_provider'] ?? null;
        $result->send_email_to_provider = $data['send_email_to_provider'] ?? null;
        $result->is_flexible = $data['is_flexible'] ?? null;
        return $result;
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
