<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * This object represents information about an order.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class OrderInfo implements TypeInterface
{
    /**
     * @var string|null User name
     */
    public ?string $name;

    /**
     * @var string|null User's phone number
     */
    public ?string $phone_number;

    /**
     * @var string|null User email
     */
    public ?string $email;

    /**
     * @var ShippingAddress|null User shipping address
     */
    public ?ShippingAddress $shipping_address;

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