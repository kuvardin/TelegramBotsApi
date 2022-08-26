<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about an incoming shipping query.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ShippingQuery extends Type
{
    /**
     * @param string $id Unique query identifier
     * @param User $from User who sent the query
     * @param string $invoice_payload Bot specified invoice payload
     * @param ShippingAddress $shipping_address User specified shipping address
     */
    public function __construct(
        public string $id,
        public User $from,
        public string $invoice_payload,
        public ShippingAddress $shipping_address,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            from: User::makeByArray($data['from']),
            invoice_payload: $data['invoice_payload'],
            shipping_address: ShippingAddress::makeByArray($data['shipping_address']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'from' => $this->from,
            'invoice_payload' => $this->invoice_payload,
            'shipping_address' => $this->shipping_address,
        ];
    }
}
