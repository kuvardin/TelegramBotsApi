<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * This object represents a shipping address.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ShippingAddress implements TypeInterface
{
    /**
     * @var string ISO 3166-1 alpha-2 country code
     */
    public string $country_code;

    /**
     * @var string State, if applicable
     */
    public string $state;

    /**
     * @var string City
     */
    public string $city;

    /**
     * @var string First line for the address
     */
    public string $street_line1;

    /**
     * @var string Second line for the address
     */
    public string $street_line2;

    /**
     * @var string Address post code
     */
    public string $post_code;

    /**
     * ShippingAddress constructor.
     *
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
     * @param string $country_code ISO 3166-1 alpha-2 country code
     * @param string $state State, if applicable
     * @param string $city City
     * @param string $street_line1 First line for the address
     * @param string $street_line2 Second line for the address
     * @param string $post_code Address post code
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
}
