<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMessageContent;

use Kuvardin\TelegramBotsApi\Types\InputMessageContent;

/**
 * Represents the <a href="https://core.telegram.org/bots/api#inputmessagecontent">content</a> of a venue message to be
 * sent as the result of an inline query.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Venue extends InputMessageContent
{
    /**
     * @var float $latitude Latitude of the venue in degrees
     */
    public float $latitude;

    /**
     * @var float $longitude Longitude of the venue in degrees
     */
    public float $longitude;

    /**
     * @var string $title Name of the venue
     */
    public string $title;

    /**
     * @var string $address Address of the venue
     */
    public string $address;

    /**
     * @var string|null $foursquare_id Foursquare identifier of the venue, if known
     */
    public ?string $foursquare_id = null;

    /**
     * @var string|null $foursquare_type Foursquare type of the venue, if known. (For example,
     *     “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
     */
    public ?string $foursquare_type = null;

    /**
     * @var string|null $google_place_id Google Places identifier of the venue
     */
    public ?string $google_place_id = null;

    /**
     * @var string|null $google_place_type Google Places type of the venue. (See <a
     *     href="https://developers.google.com/places/web-service/supported_types">supported types</a>.)
     */
    public ?string $google_place_type = null;

    public static function makeByArray(array $data): static
    {
        $result = new self;
        $result->latitude = $data['latitude'];
        $result->longitude = $data['longitude'];
        $result->title = $data['title'];
        $result->address = $data['address'];
        $result->foursquare_id = $data['foursquare_id'] ?? null;
        $result->foursquare_type = $data['foursquare_type'] ?? null;
        $result->google_place_id = $data['google_place_id'] ?? null;
        $result->google_place_type = $data['google_place_type'] ?? null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'title' => $this->title,
            'address' => $this->address,
            'foursquare_id' => $this->foursquare_id,
            'foursquare_type' => $this->foursquare_type,
            'google_place_id' => $this->google_place_id,
            'google_place_type' => $this->google_place_type,
        ];
    }
}
