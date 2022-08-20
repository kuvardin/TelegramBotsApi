<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about a poll.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Poll extends Type
{
    /**
     * @var string $id Unique poll identifier
     */
    public string $id;

    /**
     * @var string $question Poll question, 1-300 characters
     */
    public string $question;

    /**
     * @var PollOption[] $options List of poll options
     */
    public array $options;

    /**
     * @var int $total_voter_count Total number of users that voted in the poll
     */
    public int $total_voter_count;

    /**
     * @var bool $is_closed <em>True</em>, if the poll is closed
     */
    public bool $is_closed;

    /**
     * @var bool $is_anonymous <em>True</em>, if the poll is anonymous
     */
    public bool $is_anonymous;

    /**
     * @var string $type Poll type, currently can be “regular” or “quiz”
     */
    public string $type;

    /**
     * @var bool $allows_multiple_answers <em>True</em>, if the poll allows multiple answers
     */
    public bool $allows_multiple_answers;

    /**
     * @var int|null $correct_option_id 0-based identifier of the correct answer option. Available only for polls in
     *     the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.
     */
    public ?int $correct_option_id = null;

    /**
     * @var string|null $explanation Text that is shown when a user chooses an incorrect answer or taps on the lamp
     *     icon in a quiz-style poll, 0-200 characters
     */
    public ?string $explanation = null;

    /**
     * @var MessageEntity[]|null $explanation_entities Special entities like usernames, URLs, bot commands, etc. that
     *     appear in the <em>explanation</em>
     */
    public ?array $explanation_entities = null;

    /**
     * @var int|null $open_period Amount of time in seconds the poll will be active after creation
     */
    public ?int $open_period = null;

    /**
     * @var int|null $close_date Point in time (Unix timestamp) when the poll will be automatically closed
     */
    public ?int $close_date = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->id = $data['id'];
        $result->question = $data['question'];
        $result->options = [];
        foreach ($data['options'] as $item_data) {
            $result->options[] = PollOption::makeByArray($item_data);
        }
        $result->total_voter_count = $data['total_voter_count'];
        $result->is_closed = $data['is_closed'];
        $result->is_anonymous = $data['is_anonymous'];
        $result->type = $data['type'];
        $result->allows_multiple_answers = $data['allows_multiple_answers'];
        $result->correct_option_id = $data['correct_option_id'] ?? null;
        $result->explanation = $data['explanation'] ?? null;
        if (isset($data['explanation_entities'])) {
            $result->explanation_entities = [];
            foreach ($data['explanation_entities'] as $item_data) {
                $result->explanation_entities[] = MessageEntity::makeByArray($item_data);
            }
        }
        $result->open_period = $data['open_period'] ?? null;
        $result->close_date = $data['close_date'] ?? null;
        return $result;
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
            'type' => $this->type,
            'allows_multiple_answers' => $this->allows_multiple_answers,
            'correct_option_id' => $this->correct_option_id,
            'explanation' => $this->explanation,
            'explanation_entities' => $this->explanation_entities,
            'open_period' => $this->open_period,
            'close_date' => $this->close_date,
        ];
    }
}
