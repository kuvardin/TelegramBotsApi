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
     * @var int $position Position in high score table for the game
     */
    public int $position;

    /**
     * @var User $user User
     */
    public User $user;

    /**
     * @var int $score Score
     */
    public int $score;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->position = $data['position'];
        $result->user = User::makeByArray($data['user']);
        $result->score = $data['score'];
        return $result;
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
