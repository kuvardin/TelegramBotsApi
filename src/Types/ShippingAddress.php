<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this class represents a shipping address.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class ShippingAddress implements TypeInterface
{

    /**
     * @var string ISO 3166-1 alpha-2 country code
     */
    public $country_code;

    /**
     * @var string State, if applicable
     */
    public $state;

    /**
     * @var string City
     */
    public $city;

    /**
     * @var string First line for the address
     */
    public $street_line1;

    /**
     * @var string Second line for the address
     */
    public $street_line2;

    /**
     * @var string Address post code
     */
    public $post_code;

    /**
     * ShippingAddress constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->country_code = $data['country_code'];
        $this->state = $data['state'];
        $this->city = $data['city'];
        $this->street_line1 = $data['street_line1'];
        $this->street_line2 = $data['street_line2'];
        $this->post_code = $data['post_code'];
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'country_code' => $this->country_code,
            'state' => $this->state,
            'city' => $this->city,
            'street_line1' => $this->street_line1,
            'street_line2' => $this->street_line2,
            'post_code' => $this->post_code,
        ];
    }

    /**
     * @param string $country_code
     * @param string $state
     * @param string $city
     * @param string $street_line1
     * @param string $street_line2
     * @param string $post_code
     * @return ShippingAddress
     */
    public static function make(string $country_code, string $state, string $city, string $street_line1, string $street_line2, string $post_code): self
    {
        return new self([
            'country_code' => $country_code,
            'state' => $state,
            'city' => $city,
            'street_line1' => $street_line1,
            'street_line2' => $street_line2,
            'post_code' => $post_code,
        ]);
    }
}