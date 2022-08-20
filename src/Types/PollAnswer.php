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
     * @var string $poll_id Unique poll identifier
     */
    public string $poll_id;

    /**
     * @var User $user The user, who changed the answer to the poll
     */
    public User $user;

    /**
     * @var int[] $option_ids 0-based identifiers of answer options, chosen by the user. May be empty if the user
     *     retracted their vote.
     */
    public array $option_ids;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->poll_id = $data['poll_id'];
        $result->user = User::makeByArray($data['user']);
        $result->option_ids = $data['option_ids'];
        return $result;
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
