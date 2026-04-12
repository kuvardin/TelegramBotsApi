<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\StoryAreaType;

use Kuvardin\TelegramBotsApi\Types\LocationAddress;
use Kuvardin\TelegramBotsApi\Types\StoryAreaType;
use RuntimeException;

/**
 * Describes a story area pointing to a location. Currently, a story can have up to 10 location areas.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Location extends StoryAreaType
{
    /**
     * @param float $latitude Location latitude in degrees
     * @param float $longitude Location longitude in degrees
     * @param LocationAddress|null $address Address of the location
     */
    public function __construct(
        public float $latitude,
        public float $longitude,
        public ?LocationAddress $address = null,
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
            throw new RuntimeException("Wrong story area types type: {$data['type']}");
        }

        return new self(
            latitude: $data['latitude'],
            longitude: $data['longitude'],
            address: isset($data['address'])
                ? LocationAddress::makeByArray($data['address'])
                : $data['address'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
        ];
    }
}
