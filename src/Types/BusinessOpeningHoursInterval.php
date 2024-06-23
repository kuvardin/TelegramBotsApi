<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes an interval of time during which a business is open.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BusinessOpeningHoursInterval extends Type
{
    /**
     * @param int $opening_minute The minute's sequence number in a week, starting on Monday, marking the start
     *     of the time interval during which the business is open; 0 - 7 * 24 * 60
     * @param int $closing_minute The minute's sequence number in a week, starting on Monday, marking the end
     *     of the time interval during which the business is open; 0 - 8 * 24 * 60
     */
    public function __construct(
        public int $opening_minute,
        public int $closing_minute,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            opening_minute: $data['opening_minute'],
            closing_minute: $data['closing_minute'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'opening_minute' => $this->opening_minute,
            'closing_minute' => $this->closing_minute,
        ];
    }
}
