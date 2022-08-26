<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMessageContent;

use Kuvardin\TelegramBotsApi\Types\InputMessageContent;

/**
 * Represents the <a href="https://core.telegram.org/bots/api#inputmessagecontent">content</a> of a location message to
 * be sent as the result of an inline query.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Location extends InputMessageContent
{
    /**
     * @param float $latitude Latitude of the location in degrees
     * @param float $longitude Longitude of the location in degrees
     * @param float|null $horizontal_accuracy The radius of uncertainty for the location, measured in meters; 0-1500
     * @param int|null $live_period Period in seconds for which the location can be updated, should be between 60 and
     *     86400.
     * @param int|null $heading For live locations, a direction in which the user is moving, in degrees. Must be
     *     between 1 and 360 if specified.
     * @param int|null $proximity_alert_radius For live locations, a maximum distance for proximity alerts about
     *     approaching another chat member, in meters. Must be between 1 and 100000 if specified.
     */
    public function __construct(
        public float $latitude,
        public float $longitude,
        public ?float $horizontal_accuracy = null,
        public ?int $live_period = null,
        public ?int $heading = null,
        public ?int $proximity_alert_radius = null,
    )
    {

    }

    public static function makeByArray(array $data): static
    {
        return new self(
            latitude: $data['latitude'],
            longitude: $data['longitude'],
            horizontal_accuracy: $data['horizontal_accuracy'] ?? null,
            live_period: $data['live_period'] ?? null,
            heading: $data['heading'] ?? null,
            proximity_alert_radius: $data['proximity_alert_radius'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'horizontal_accuracy' => $this->horizontal_accuracy,
            'live_period' => $this->live_period,
            'heading' => $this->heading,
            'proximity_alert_radius' => $this->proximity_alert_radius,
        ];
    }
}
