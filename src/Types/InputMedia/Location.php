<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMedia;

use Kuvardin\TelegramBotsApi\Types\InputMedia;
use Kuvardin\TelegramBotsApi\Types\InputPollMedia;
use Kuvardin\TelegramBotsApi\Types\InputPollOptionMedia;
use RuntimeException;

/**
 * Represents a location to be sent.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Location extends InputMedia implements InputPollMedia, InputPollOptionMedia
{
    /**
     * @param float $latitude Latitude of the location
     * @param float $longitude Longitude of the location
     * @param float|null $horizontal_accuracy The radius of uncertainty for the location, measured in meters; 0-1500
     */
    public function __construct(
        public float $latitude,
        public float $longitude,
        public ?float $horizontal_accuracy = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'location';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input media type: {$data['type']}");
        }

        return new self(
            latitude: $data['latitude'],
            longitude: $data['longitude'],
            horizontal_accuracy: $data['horizontal_accuracy'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'horizontal_accuracy' => $this->horizontal_accuracy,
        ];
    }
}





