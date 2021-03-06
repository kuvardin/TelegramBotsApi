<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * This object represents information about an order.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class OrderInfo implements TypeInterface
{
    /**
     * @var string|null User name
     */
    public ?string $name = null;

    /**
     * @var string|null User's phone number
     */
    public ?string $phone_number = null;

    /**
     * @var string|null User email
     */
    public ?string $email = null;

    /**
     * @var ShippingAddress|null User shipping address
     */
    public ?ShippingAddress $shipping_address = null;

    /**
     * OrderInfo constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (isset($data['name'])) {
            $this->name = $data['name'];
        }

        if (isset($data['phone_number'])) {
            $this->phone_number = $data['phone_number'];
        }

        if (isset($data['email'])) {
            $this->email = $data['email'];
        }

        if (isset($data['shipping_address'])) {
            $this->shipping_address = $data['shipping_address'] instanceof ShippingAddress
                ? $data['shipping_address']
                : new ShippingAddress($data['shipping_address']);
        }
    }

    /**
     * @return OrderInfo
     */
    public static function make(): self
    {
        return new self([
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'shipping_address' => $this->shipping_address,
        ];
    }
}
