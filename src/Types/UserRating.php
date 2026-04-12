<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes the rating of a user based on their Telegram Star spendings.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UserRating extends Type
{
    /**
     * @param int $level Current level of the user, indicating their reliability when purchasing digital goods and
     *     services. A higher level suggests a more trustworthy customer; a negative level is likely reason for concern.
     * @param int $rating Numerical value of the user's rating; the higher the rating, the better
     * @param int $current_level_rating The rating value required to get the current level
     * @param int|null $next_level_rating The rating value required to get to the next level; omitted if the maximum
     *     level was reached
     */
    public function __construct(
        public int $level,
        public int $rating,
        public int $current_level_rating,
        public ?int $next_level_rating = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            level: $data['level'],
            rating: $data['rating'],
            current_level_rating: $data['current_level_rating'],
            next_level_rating: $data['next_level_rating'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'level' => $this->level,
            'rating' => $this->rating,
            'current_level_rating' => $this->current_level_rating,
            'next_level_rating' => $this->next_level_rating,
        ];
    }
}
