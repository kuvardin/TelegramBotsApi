<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents one row of the high scores table for a game.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GameHighScore extends Type
{
    /**
     * @param int $position Position in high score table for the game
     * @param User $user User
     * @param int $score Score
     */
    public function __construct(
        public int $position,
        public User $user,
        public int $score,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            position: $data['position'],
            user: User::makeByArray($data['user']),
            score: $data['score'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'position' => $this->position,
            'user' => $this->user,
            'score' => $this->score,
        ];
    }
}
