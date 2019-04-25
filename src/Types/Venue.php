<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represents a venue
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Venue implements TypeInterface
{
    /**
     * @var Location Venue location
     */
    public $location;

    /**
     * @var string Name of the venue
     */
    public $title;

    /**
     * @var string Address of the venue
     */
    public $address;

    /**
     * @var string|null Foursquare identifier of the venue
     */
    public $foursquare_id;

    /**
     * @var string|null Foursquare type of the venue. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
     */
    public $foursquare_type;

    /**
     * Venue constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->location = is_array($data['location']) ? new Location($data['location']) : $data['location'];
        $this->title = $data['title'];
        $this->address = $data['address'];
        $this->foursquare_id = $data['foursquare_id'] ?? null;
        $this->foursquare_type = $data['foursquare_type'] ?? null;
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

    /**
     * @param Location $location
     * @param string $title
     * @param string $address
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
}