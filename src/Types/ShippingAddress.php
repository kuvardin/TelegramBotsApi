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
     * @var string $country_code ISO 3166-1 alpha-2 country code
     */
    public string $country_code;

    /**
     * @var string $state State, if applicable
     */
    public string $state;

    /**
     * @var string $city City
     */
    public string $city;

    /**
     * @var string $street_line1 First line for the address
     */
    public string $street_line1;

    /**
     * @var string $street_line2 Second line for the address
     */
    public string $street_line2;

    /**
     * @var string $post_code Address post code
     */
    public string $post_code;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->country_code = $data['country_code'];
        $result->state = $data['state'];
        $result->city = $data['city'];
        $result->street_line1 = $data['street_line1'];
        $result->street_line2 = $data['street_line2'];
        $result->post_code = $data['post_code'];
        return $result;
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
