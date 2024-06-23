<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes the opening hours of a business.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BusinessOpeningHours extends Type
{
    /**
     * @param string $time_zone_name Unique name of the time zone for which the opening hours are defined
     * @param BusinessOpeningHoursInterval[] $opening_hours List of time intervals describing business opening hours
     */
    public function __construct(
        public string $time_zone_name,
        public array $opening_hours,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            time_zone_name: $data['time_zone_name'],
            opening_hours: array_map(
                static fn(array $opening_hour_data) => BusinessOpeningHoursInterval::makeByArray($opening_hour_data),
                $data['opening_hours']
            ),
        );
    }

    public function getRequestData(): array
    {
        return [
            'time_zone_name' => $this->time_zone_name,
            'opening_hours' => $this->opening_hours,
        ];
    }
}
