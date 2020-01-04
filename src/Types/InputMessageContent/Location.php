<?php declare(strict_types=1);

namespace TelegramBotsApi\Types\InputMessageContent;

use TelegramBotsApi;
use TelegramBotsApi\Types;

/**
 * Represents the content of a location message to be sent as the result of an inline query.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Location extends Types\InputMessageContent implements Types\TypeInterface
{
    public const TYPE = Types\InputMessageContent::TYPE_LOCATION;

    /**
     * @var float Latitude of the location in degrees
     */
    public float $latitude;

    /**
     * @var float Longitude of the location in degrees
     */
    public float $longitude;

    /**
     * @var int|null Period in seconds for which the location can be updated, should be between 60 and 86400.
     */
    public ?int $live_period = null;

    /**
     * Location constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];

        if (isset($data['live_period'])) {
            $this->live_period = $data['live_period'];
        }
    }

    /**
     * @param float $latitude Latitude of the location in degrees
     * @param float $longitude Longitude of the location in degrees
     * @return Location
     */
    public static function make(float $latitude, float $longitude): self
    {
        return new self([
            'latitude' => $latitude,
            'longitude' => $longitude,
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
            'live_period' => $this->live_period,
        ];
    }
}