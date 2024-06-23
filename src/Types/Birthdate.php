<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes the birthdate of a user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Birthdate extends Type
{
    /**
     * @param int $day Day of the user's birth; 1-31
     * @param int $month Month of the user's birth; 1-12
     * @param int|null $year Year of the user's birth
     */
    public function __construct(
        public int $day,
        public int $month,
        public ?int $year = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            day: $data['day'],
            month: $data['month'],
            year: $data['year'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'day' => $this->day,
            'month' => $this->month,
            'year' => $this->year,
        ];
    }
}
