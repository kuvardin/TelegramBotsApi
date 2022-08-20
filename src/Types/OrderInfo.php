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
     * @var string|null $name User name
     */
    public ?string $name = null;

    /**
     * @var string|null $phone_number User's phone number
     */
    public ?string $phone_number = null;

    /**
     * @var string|null $email User email
     */
    public ?string $email = null;

    /**
     * @var ShippingAddress|null $shipping_address User shipping address
     */
    public ?ShippingAddress $shipping_address = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->name = $data['name'] ?? null;
        $result->phone_number = $data['phone_number'] ?? null;
        $result->email = $data['email'] ?? null;
        $result->shipping_address = isset($data['shipping_address'])
            ? ShippingAddress::makeByArray($data['shipping_address'])
            : null;
        return $result;
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
