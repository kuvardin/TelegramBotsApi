<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents information about an order.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class OrderInfo extends Type
{
    /**
     * @param string|null $name User name
     * @param string|null $phone_number User's phone number
     * @param string|null $email User email
     * @param ShippingAddress|null $shipping_address User shipping address
     */
    public function __construct(
        public ?string $name = null,
        public ?string $phone_number = null,
        public ?string $email = null,
        public ?ShippingAddress $shipping_address = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            phone_number: $data['phone_number'] ?? null,
            email: $data['email'] ?? null,
            shipping_address: isset($data['shipping_address'])
                ? ShippingAddress::makeByArray($data['shipping_address'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'shipping_address' => $this->shipping_address,
        ];
    }
}
