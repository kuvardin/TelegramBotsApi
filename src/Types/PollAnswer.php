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
     * @param int[] $option_ids 0-based identifiers of chosen answer options. May be empty if the vote was retracted.
     * @param Chat|null $voter_chat The chat that changed the answer to the poll, if the voter is anonymous
     * @param User|null $user The user that changed the answer to the poll, if the voter isn't anonymous
     */
    public function __construct(
        public string $poll_id,
        public array $option_ids,
        public ?Chat $voter_chat = null,
        public ?User $user = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        $result = new self(
            poll_id: $data['poll_id'],
            option_ids: $data['option_ids'],
            voter_chat: isset($data['voter_chat'])
                ? Chat::makeByArray($data['voter_chat'])
                : null,
            user: isset($data['user'])
                ? User::makeByArray($data['user'])
                : null,
        );

        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'poll_id' => $this->poll_id,
            'voter_chat' => $this->voter_chat,
            'user' => $this->user,
            'option_ids' => $this->option_ids,
        ];
    }
}
