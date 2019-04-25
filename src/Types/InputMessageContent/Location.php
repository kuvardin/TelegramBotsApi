<?php

namespace TelegramBotsApi\Types\InputMessageContent;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Represents the content of a location message to be sent as the result of an inline query.
 * @package TelegramBotsApi\Types\InputMessageContent
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Location extends TelegramBotsApi\Types\InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = TelegramBotsApi\Types\InputMessageContent::TYPE_LOCATION;

    /**
     * @var float Latitude of the location in degrees
     */
    public $latitude;

    /**
     * @var float Longitude of the location in degrees
     */
    public $longitude;

    /**
     * @var int|null Period in seconds for which the location can be updated, should be between 60 and 86400.
     */
    public $live_period;

    /**
     * Location constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
        $this->live_period = $data['live_period'] ?? null;
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

    /**
     * @param float $latitude
     * @param float $longitude
     * @return Location
     */
    public static function make(float $latitude, float $longitude): self
    {
        return new self([
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }
}