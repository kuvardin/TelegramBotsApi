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
     * @var float $latitude Latitude of the location in degrees
     */
    public float $latitude;

    /**
     * @var float $longitude Longitude of the location in degrees
     */
    public float $longitude;

    /**
     * @var float|null $horizontal_accuracy The radius of uncertainty for the location, measured in meters; 0-1500
     */
    public ?float $horizontal_accuracy = null;

    /**
     * @var int|null $live_period Period in seconds for which the location can be updated, should be between 60 and
     *     86400.
     */
    public ?int $live_period = null;

    /**
     * @var int|null $heading For live locations, a direction in which the user is moving, in degrees. Must be between
     *     1 and 360 if specified.
     */
    public ?int $heading = null;

    /**
     * @var int|null $proximity_alert_radius For live locations, a maximum distance for proximity alerts about
     *     approaching another chat member, in meters. Must be between 1 and 100000 if specified.
     */
    public ?int $proximity_alert_radius = null;

    public static function makeByArray(array $data): static
    {
        $result = new self;
        $result->latitude = $data['latitude'];
        $result->longitude = $data['longitude'];
        $result->horizontal_accuracy = $data['horizontal_accuracy'] ?? null;
        $result->live_period = $data['live_period'] ?? null;
        $result->heading = $data['heading'] ?? null;
        $result->proximity_alert_radius = $data['proximity_alert_radius'] ?? null;
        return $result;
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
