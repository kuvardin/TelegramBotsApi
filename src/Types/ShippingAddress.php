<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a shipping address.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ShippingAddress extends Type
{
    /**
     * @param string $country_code ISO 3166-1 alpha-2 country code
     * @param string $state State, if applicable
     * @param string $city City
     * @param string $street_line1 First line for the address
     * @param string $street_line2 Second line for the address
     * @param string $post_code Address post code
     */
    public function __construct(
        public string $country_code,
        public string $state,
        public string $city,
        public string $street_line1,
        public string $street_line2,
        public string $post_code,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            country_code: $data['country_code'],
            state: $data['state'],
            city: $data['city'],
            street_line1: $data['street_line1'],
            street_line2: $data['street_line2'],
            post_code: $data['post_code'],
        );
    }

    public function getRequestData(): array
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
