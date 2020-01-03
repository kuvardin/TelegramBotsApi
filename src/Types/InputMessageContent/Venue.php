<?php declare(strict_types=1);

namespace TelegramBotsApi\Types\InputMessageContent;

use TelegramBotsApi;
use TelegramBotsApi\Types;

/**
 * Represents the content of a venue message to be sent as the result of an inline query.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Venue extends Types\InputMessageContent implements Types\TypeInterface
{
    public const TYPE = Types\InputMessageContent::TYPE_VENUE;

    /**
     * @var float Latitude of the venue in degrees
     */
    public float $latitude;

    /**
     * @var float Longitude of the venue in degrees
     */
    public float $longitude;

    /**
     * @var string Name of the venue
     */
    public string $title;

    /**
     * @var string Address of the venue
     */
    public string $address;

    /**
     * @var string|null Foursquare identifier of the venue, if known
     */
    public ?string $foursquare_id;

    /**
     * @var string|null Foursquare type of the venue, if known. (For example, “arts_entertainment/default”,
     * “arts_entertainment/aquarium” or “food/icecream”.)
     */
    public ?string $foursquare_type;

    /**
     * Venue constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
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
     * @param float $latitude Latitude of the venue in degrees
     * @param float $longitude Longitude of the venue in degrees
     * @param string $title Name of the venue
     * @param string $address Address of the venue
     * @return Venue
     */
    public static function make(float $latitude, float $longitude, string $title, string $address): self
    {
        return new self([
            'latitude' => $latitude,
            'longitude' => $longitude,
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
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'title' => $this->title,
            'address' => $this->address,
            'foursquare_id' => $this->foursquare_id,
            'foursquare_type' => $this->foursquare_type,
        ];
    }
}