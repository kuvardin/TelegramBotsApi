<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use Kuvardin\TelegramBotsApi\Enums\PollType;

/**
 * This object contains information about a poll.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Poll extends Type
{
    /**
     * @param string $id Unique poll identifier
     * @param string $question Poll question, 1-300 characters
     * @param PollOption[] $options List of poll options
     * @param int $total_voter_count Total number of users that voted in the poll
     * @param bool $is_closed True, if the poll is closed
     * @param bool $is_anonymous True, if the poll is anonymous
     * @param PollType|string $type_value Poll type
     * @param bool $allows_multiple_answers True, if the poll allows multiple answers
     * @param bool $allows_revoting True, if the poll allows to change the chosen answer options
     * @param int|null $correct_option_id
     * @param string|null $explanation Text that is shown when a user chooses an incorrect answer or taps on the lamp
     *     icon in a quiz-style poll, 0-200 characters
     * @param MessageEntity[]|null $explanation_entities Special entities like usernames, URLs, bot commands, etc. that
     *     appear in the "explanation"
     * @param int|null $open_period Amount of time in seconds the poll will be active after creation
     * @param int|null $close_date Point in time (Unix timestamp) when the poll will be automatically closed
     * @param MessageEntity[]|null $question_entities Special entities that appear in the "question". Currently, only
     *     custom emoji entities are allowed in poll questions
     * @param int[]|null $correct_option_ids Array of 0-based identifiers of the correct answer options. Available only
     *     for polls in quiz mode which are closed or were sent (not forwarded) by the bot or to the private chat with
     *     the bot.
     * @param string|null $description Description of the poll; for polls inside the Message object only
     * @param MessageEntity[]|null $description_entities Special entities like usernames, URLs, bot commands, etc. that
     *     appear in the description
     */
    public function __construct(
        public string $id,
        public string $question,
        public array $options,
        public int $total_voter_count,
        public bool $is_closed,
        public bool $is_anonymous,
        public PollType|string $type_value,
        public bool $allows_multiple_answers,
        public bool $allows_revoting,
        public ?int $correct_option_id = null,
        public ?string $explanation = null,
        public ?array $explanation_entities = null,
        public ?int $open_period = null,
        public ?int $close_date = null,
        public ?array $question_entities = null,
        public ?array $correct_option_ids = null,
        public ?string $description = null,
        public ?array $description_entities = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            question: $data['question'],
            options: array_map(
                static fn(array $options_data) => PollOption::makeByArray($options_data),
                $data['options'],
            ),
            total_voter_count: $data['total_voter_count'],
            is_closed: $data['is_closed'],
            is_anonymous: $data['is_anonymous'],
            type_value: $data['type'],
            allows_multiple_answers: $data['allows_multiple_answers'],
            allows_revoting: $data['allows_revoting'],
            correct_option_id: $data['correct_option_id'] ?? null,
            explanation: $data['explanation'] ?? null,
            explanation_entities: isset($data['explanation_entities'])
                ? array_map(
                    static fn(array $explanation_entities_data) => MessageEntity::makeByArray($explanation_entities_data),
                    $data['explanation_entities'],
                )
                : null,
            open_period: $data['open_period'] ?? null,
            close_date: $data['close_date'] ?? null,
            question_entities: isset($data['question_entities'])
                ? array_map(
                    static fn(array $question_entities_data) => MessageEntity::makeByArray($question_entities_data),
                    $data['question_entities'],
                )
                : null,
            correct_option_ids: $data['correct_option_ids'] ?? null,
            description: $data['description'] ?? null,
            description_entities: isset($data['description_entities'])
                ? array_map(
                    static fn(array $entity_data) => MessageEntity::makeByArray($entity_data),
                    $data['description_entities'],
                )
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'options' => $this->options,
            'total_voter_count' => $this->total_voter_count,
            'is_closed' => $this->is_closed,
            'is_anonymous' => $this->is_anonymous,
            'type' => $this->type_value,
            'allows_multiple_answers' => $this->allows_multiple_answers,
            'allows_revoting' => $this->allows_revoting,
            'correct_option_id' => $this->correct_option_id,
            'explanation' => $this->explanation,
            'explanation_entities' => $this->explanation_entities,
            'open_period' => $this->open_period,
            'close_date' => $this->close_date,
            'correct_option_ids' => $this->correct_option_ids,
            'description' => $this->description,
            'description_entities' => $this->description_entities,
        ];
    }

    /**
     * @return PollType|null Returns Null if the poll type value is unknown.
     */
    public function getType(): ?PollType
    {
        return is_string($this->type_value)
            ? PollType::tryFrom($this->type_value)
            : $this->type_value;
    }
}
