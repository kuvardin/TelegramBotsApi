<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi;
use Kuvardin\TelegramBotsApi\Exceptions\Error;

/**
 * This object represents an answer of a user in a non-anonymous poll.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PollAnswer implements TypeInterface
{
    /**
     * @var string Unique poll identifier
     */
    public string $poll_id;

    /**
     * @var User The user, who changed the answer to the poll
     */
    public User $user;

    /**
     * @var int[] 0-based identifiers of answer options, chosen by the user. May be empty if the user retracted
     * their vote.
     */
    public array $option_ids;

    /**
     * PollAnswer constructor.
     *
     * @param array $data
     * @throws TelegramBotsApi\Exceptions\Error
     */
    public function __construct(array $data)
    {
        $this->poll_id = $data['poll_id'];
        $this->user = new User($data['user']);
        $this->option_ids = $data['option_ids'];
    }

    /**
     * @param string $poll_id Unique poll identifier
     * @param User $user The user, who changed the answer to the poll
     * @param int[] $option_ids 0-based identifiers of answer options, chosen by the user. May be empty if
     * the user retracted their vote.
     * @return PollAnswer
     * @throws Error
     */
    public static function make(string $poll_id, User $user, array $option_ids): self
    {
        return new self([
            'poll_id' => $poll_id,
            'user' => $user,
            'option_ids' => $option_ids,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'poll_id' => $this->poll_id,
            'user' => $this->user,
            'option_ids' => $this->option_ids,
        ];
    }
}
