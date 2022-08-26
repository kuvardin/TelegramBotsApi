<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a venue.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Venue extends Type
{
    /**
     * @param Location $location Venue location. Can't be a live location
     * @param string $title Name of the venue
     * @param string $address Address of the venue
     * @param string|null $foursquare_id Foursquare identifier of the venue
     * @param string|null $foursquare_type Foursquare type of the venue. (For example, “arts_entertainment/default”,
     *     “arts_entertainment/aquarium” or “food/icecream”.)
     * @param string|null $google_place_id Google Places identifier of the venue
     * @param string|null $google_place_type Google Places type of the venue. (See <a
     *     href="https://developers.google.com/places/web-service/supported_types">supported types</a>.)
     */
    public function __construct(
        public Location $location,
        public string $title,
        public string $address,
        public ?string $foursquare_id = null,
        public ?string $foursquare_type = null,
        public ?string $google_place_id = null,
        public ?string $google_place_type = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            location: Location::makeByArray($data['location']),
            title: $data['title'],
            address: $data['address'],
            foursquare_id: $data['foursquare_id'] ?? null,
            foursquare_type: $data['foursquare_type'] ?? null,
            google_place_id: $data['google_place_id'] ?? null,
            google_place_type: $data['google_place_type'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'location' => $this->location,
            'title' => $this->title,
            'address' => $this->address,
            'foursquare_id' => $this->foursquare_id,
            'foursquare_type' => $this->foursquare_type,
            'google_place_id' => $this->google_place_id,
            'google_place_type' => $this->google_place_type,
        ];
    }
}
