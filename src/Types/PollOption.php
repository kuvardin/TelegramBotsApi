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
     * @var string $text Option text, 1-100 characters
     */
    public string $text;

    /**
     * @var int $voter_count Number of users that voted for this option
     */
    public int $voter_count;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->text = $data['text'];
        $result->voter_count = $data['voter_count'];
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'text' => $this->text,
            'voter_count' => $this->voter_count,
        ];
    }
}
