<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Exceptions\Error;

/**
 * This object represents one row of the high scores table for a game.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GameHighScore implements TypeInterface
{
    /**
     * @var int Position in high score table for the game
     */
    public int $position;

    /**
     * @var User User
     */
    public User $user;

    /**
     * @var int Score
     */
    public int $score;

    /**
     * GameHighScore constructor.
     *
     * @param array $data
     * @throws Error
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->position = $data['position'];
        $this->user = $data['user'] instanceof User
            ? $data['user']
            : new User($data['user']);
        $this->score = $data['score'];
    }

    /**
     * @param int $position Position in high score table for the game
     * @param User $user User
     * @param int $score Score
     * @return GameHighScore
     * @throws Error
     * @throws Error
     */
    public static function make(int $position, User $user, int $score): self
    {
        return new self([
            'position' => $position,
            'user' => $user,
            'score' => $score,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'position' => $this->position,
            'user' => $this->user,
            'score' => $this->score,
        ];
    }
}
