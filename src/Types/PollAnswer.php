<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents an answer of a user in a non-anonymous poll.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PollAnswer extends Type
{
    /**
     * @param string $poll_id Unique poll identifier
     * @param User $user The user, who changed the answer to the poll
     * @param int[] $option_ids 0-based identifiers of answer options, chosen by the user. May be empty if the user
     *     retracted their vote.
     */
    public function __construct(
        public string $poll_id,
        public User $user,
        public array $option_ids,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            poll_id: $data['poll_id'],
            user: User::makeByArray($data['user']),
            option_ids: $data['option_ids'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'poll_id' => $this->poll_id,
            'user' => $this->user,
            'option_ids' => $this->option_ids,
        ];
    }
}
