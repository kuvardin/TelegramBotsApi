<?php

namespace TelegramBotsApi\Types\InputMessageContent;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Represents the content of a venue message to be sent as the result of an inline query.
 * @package TelegramBotsApi\Types\InputMessageContent
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Venue extends TelegramBotsApi\Types\InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = TelegramBotsApi\Types\InputMessageContent::TYPE_VENUE;

    /**
     * @var float Latitude of the venue in degrees
     */
    public $latitude;

    /**
     * @var float Longitude of the venue in degrees
     */
    public $longitude;

    /**
     * @var string Name of the venue
     */
    public $title;

    /**
     * @var string Address of the venue
     */
    public $address;

    /**
     * @var string|null Foursquare identifier of the venue, if known
     */
    public $foursquare_id;

    /**
     * @var string|null Foursquare type of the venue, if known. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
     */
    public $foursquare_type;

    /**
     * Venue constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
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
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'title' => $this->title,
            'address' => $this->address,
            'foursquare_id' => $this->foursquare_id,
            'foursquare_type' => $this->foursquare_type,
        ];
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @param string $title
     * @param string $address
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
}