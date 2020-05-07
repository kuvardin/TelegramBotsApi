<?php

declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * This object represents a venue.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Venue implements TypeInterface
{
    /**
     * @var Location Venue location
     */
    public Location $location;

    /**
     * @var string Name of the venue
     */
    public string $title;

    /**
     * @var string Address of the venue
     */
    public string $address;

    /**
     * @var string|null Foursquare identifier of the venue
     */
    public ?string $foursquare_id = null;

    /**
     * @var string|null Foursquare type of the venue. (For example, “arts_entertainment/default”,
     * “arts_entertainment/aquarium” or “food/icecream”.)
     */
    public ?string $foursquare_type = null;

    /**
     * Venue constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->location = $data['location'] instanceof Location
            ? $data['location']
            : new Location($data['location']);

        $this->title = $data['title'];
        $this->address = $data['address'];

        if (isset($data['foursquare_id'])) {
            $this->foursquare_id = $data['foursquare_id'];
        }

        if (isset($data['foursquare_type'])) {
            $this->foursquare_type = $data['foursquare_type'];
        }
    }

    /**
     * @param Location $location Venue location
     * @param string $title Name of the venue
     * @param string $address Address of the venue
     * @return Venue
     */
    public static function make(Location $location, string $title, string $address): self
    {
        return new self([
            'location' => $location,
            'title' => $title,
            'address' => $address,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'location' => $this->location,
            'title' => $this->title,
            'address' => $this->address,
            'foursquare_id' => $this->foursquare_id,
            'foursquare_type' => $this->foursquare_type,
        ];
    }
}
