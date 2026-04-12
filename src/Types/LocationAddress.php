<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes the physical address of a location.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class LocationAddress extends Type
{
    /**
     * @param string $country_code The two-letter ISO 3166-1 alpha-2 country code of the country where the location is
     *     located
     * @param string|null $state State of the location
     * @param string|null $city City of the location
     * @param string|null $street Street address of the location
     */
    public function __construct(
        public string $country_code,
        public ?string $state = null,
        public ?string $city = null,
        public ?string $street = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            country_code: $data['country_code'],
            state: $data['state'] ?? null,
            city: $data['city'] ?? null,
            street: $data['street'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'country_code' => $this->country_code,
            'state' => $this->state,
            'city' => $this->city,
            'street' => $this->street,
        ];
    }
}
