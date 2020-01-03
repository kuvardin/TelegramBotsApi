<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * This object contains information about an incoming shipping query.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ShippingQuery implements TypeInterface
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
     * @var string Bot specified invoice payload
     */
    public string $invoice_payload;

    /**
     * @var ShippingAddress User specified shipping address
     */
    public ShippingAddress $shipping_address;

    /**
     * ShippingQuery constructor.
     *
     * @param array $data
     * @throws Error
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->from = $data['from'] instanceof User ? $data['from'] : new User($data['from']);
        $this->invoice_payload = $data['invoice_payload'];
        $this->shipping_address = $data['shipping_address'] instanceof ShippingAddress
            ? $data['shipping_address']
            : new ShippingAddress($data['shipping_address']);
    }

    /**
     * @param string $id Unique query identifier
     * @param User $from User who sent the query
     * @param string $invoice_payload Bot specified invoice payload
     * @param ShippingAddress $shipping_address User specified shipping address
     * @return ShippingQuery
     * @throws Error
     * @throws Error
     */
    public static function make(string $id, User $from, string $invoice_payload, ShippingAddress $shipping_address): self
    {
        return new self([
            'id' => $id,
            'from' => $from,
            'invoice_payload' => $invoice_payload,
            'shipping_address' => $shipping_address,
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
            'invoice_payload' => $this->invoice_payload,
            'shipping_address' => $this->shipping_address,
        ];
    }
}