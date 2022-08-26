<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a point on the map.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Location extends Type
{
    /**
     * @param float $longitude Longitude as defined by sender
     * @param float $latitude Latitude as defined by sender
     * @param float|null $horizontal_accuracy The radius of uncertainty for the location, measured in meters; 0-1500
     * @param int|null $live_period Time relative to the message sending date, during which the location can be
     *     updated; in seconds. For active live locations only.
     * @param int|null $heading The direction in which user is moving, in degrees; 1-360. For active live locations
     *     only.
     * @param int|null $proximity_alert_radius Maximum distance for proximity alerts about approaching another chat
     *     member, in meters. For sent live locations only.
     */
    public function __construct(
        public float $longitude,
        public float $latitude,
        public ?float $horizontal_accuracy = null,
        public ?int $live_period = null,
        public ?int $heading = null,
        public ?int $proximity_alert_radius = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            longitude: $data['longitude'],
            latitude: $data['latitude'],
            horizontal_accuracy: $data['horizontal_accuracy'] ?? null,
            live_period: $data['live_period'] ?? null,
            heading: $data['heading'] ?? null,
            proximity_alert_radius: $data['proximity_alert_radius'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'horizontal_accuracy' => $this->horizontal_accuracy,
            'live_period' => $this->live_period,
            'heading' => $this->heading,
            'proximity_alert_radius' => $this->proximity_alert_radius,
        ];
    }
}
