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
     * @var string $id Unique query identifier
     */
    public string $id;

    /**
     * @var User $from User who sent the query
     */
    public User $from;

    /**
     * @var string $invoice_payload Bot specified invoice payload
     */
    public string $invoice_payload;

    /**
     * @var ShippingAddress $shipping_address User specified shipping address
     */
    public ShippingAddress $shipping_address;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->id = $data['id'];
        $result->from = User::makeByArray($data['from']);
        $result->invoice_payload = $data['invoice_payload'];
        $result->shipping_address = ShippingAddress::makeByArray($data['shipping_address']);
        return $result;
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
