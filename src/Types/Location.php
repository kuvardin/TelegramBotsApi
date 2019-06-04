<?php

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * Instance of this object represents a point on the map
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Location implements TypeInterface
{
    /**
     * @var float Longitude as defined by sender
     */
    public $longitude;

    /**
     * @var float Latitude as defined by sender
     */
    public $latitude;

    /**
     * Location constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->longitude = $data['longitude'];
        $this->latitude = $data['latitude'];
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        ];
    }

    /**
     * @param float $longitude
     * @param float $latitude
     * @return Location
     */
    public static function make(float $longitude, float $latitude): self
    {
        return new self([
            'longitude' => $longitude,
            'latitude' => $latitude,
        ]);
    }
}