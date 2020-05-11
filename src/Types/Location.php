<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * This object represents a point on the map.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Location implements TypeInterface
{
    /**
     * @var float Longitude as defined by sender
     */
    public float $longitude;

    /**
     * @var float Latitude as defined by sender
     */
    public float $latitude;

    /**
     * Location constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->longitude = $data['longitude'];
        $this->latitude = $data['latitude'];
    }

    /**
     * @param float $longitude Longitude as defined by sender
     * @param float $latitude Latitude as defined by sender
     * @return Location
     */
    public static function make(float $longitude, float $latitude): self
    {
        return new self([
            'longitude' => $longitude,
            'latitude' => $latitude,
        ]);
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
}
