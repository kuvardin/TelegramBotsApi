<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about one answer option in a poll.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PollOption extends Type
{
    /**
     * @param string $text Option text, 1-100 characters
     * @param int $voter_count Number of users that voted for this option
     */
    public function __construct(
        public string $text,
        public int $voter_count,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            text: $data['text'],
            voter_count: $data['voter_count'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'text' => $this->text,
            'voter_count' => $this->voter_count,
        ];
    }
}
