<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * This object represents one row of the high scores table for a game.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class GameHighScore implements TypeInterface
{

    /**
     * @var int Position in high score table for the game
     */
    public $position;

    /**
     * @var User User
     */
    public $user;

    /**
     * @var int Score
     */
    public $score;

    /**
     * GameHighScore constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->position = $data['position'];
        $this->user = $data['user'] instanceof User ? $data['user'] : new User($data['user']);
        $this->score = $data['score'];
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

    /**
     * @param int $position
     * @param User $user
     * @param int $score
     * @return GameHighScore
     */
    public static function make(int $position, User $user, int $score): self
    {
        return new self([
            'position' => $position,
            'user' => $user,
            'score' => $score,
        ]);
    }
}