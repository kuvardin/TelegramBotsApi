<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this class represents information about an order.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class OrderInfo implements TypeInterface
{

    /**
     * @var string|null User name
     */
    public $name;

    /**
     * @var string|null User's phone number
     */
    public $phone_number;

    /**
     * @var string|null User email
     */
    public $email;

    /**
     * @var ShippingAddress|null User shipping address
     */
    public $shipping_address;

    /**
     * OrderInfo constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? null;
        $this->phone_number = $data['phone_number'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->shipping_address = $data['shipping_address'] instanceof ShippingAddress ? $data['shipping_address'] : new ShippingAddress($data['shipping_address']);
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

    /**
     * @return OrderInfo
     */
    public static function make(): self
    {
        return new self([

        ]);
    }
}