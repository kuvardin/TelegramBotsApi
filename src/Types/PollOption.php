<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * This object contains information about one answer option in a poll.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PollOption implements TypeInterface
{
    /**
     * @var string Option text, 1-100 characters
     */
    public string $text;

    /**
     * @var int Number of users that voted for this option
     */
    public int $voter_count;

    /**
     * PollOption constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->text = $data['text'];
        $this->voter_count = $data['voter_count'];
    }

    /**
     * @param string $text Option text, 1-100 characters
     * @param int $voter_count Number of users that voted for this option
     * @return PollOption
     */
    public static function make(string $text, int $voter_count): self
    {
        return new self([
            'text' => $text,
            'voter_count' => $voter_count,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'text' => $this->text,
            'voter_count' => $this->voter_count,
        ];
    }
}
