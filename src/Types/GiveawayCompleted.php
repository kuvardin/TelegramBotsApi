<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a service message about the completion of a giveaway without public winners.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GiveawayCompleted extends Type
{
    /**
     * @param int $winner_count Number of winners in the giveaway
     * @param int|null $unclaimed_prize_count Number of undistributed prizes
     * @param Message|null $giveaway_message Message with the giveaway that was completed, if it wasn't deleted
     * @param bool|null $is_star_giveaway "True", if the giveaway is a Telegram Star giveaway. Otherwise, currently,
     *     the giveaway is a Telegram Premium giveaway.
     */
    public function __construct(
        public int $winner_count,
        public ?int $unclaimed_prize_count = null,
        public ?Message $giveaway_message = null,
        public ?bool $is_star_giveaway = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            winner_count: $data['winner_count'],
            unclaimed_prize_count: $data['unclaimed_prize_count'] ?? null,
            giveaway_message: isset($data['giveaway_message'])
                ? Message::makeByArray($data['giveaway_message'])
                : null,
            is_star_giveaway: $data['is_star_giveaway'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'winner_count' => $this->winner_count,
            'unclaimed_prize_count' => $this->unclaimed_prize_count,
            'giveaway_message' => $this->giveaway_message,
            'is_star_giveaway' => $this->is_star_giveaway,
        ];
    }
}
