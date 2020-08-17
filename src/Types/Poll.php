<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Exceptions\Error;

/**
 * This object contains information about a poll.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Poll implements TypeInterface
{
    public const TYPE_QUIZ = 'quiz';
    public const TYPE_REGULAR = 'regular';

    /**
     * @var string Unique poll identifier
     */
    public string $id;

    /**
     * @var string Poll question, 1-255 characters
     */
    public string $question;

    /**
     * @var PollOption[] List of poll options
     */
    public array $options = [];

    /**
     * @var int Total number of users that voted in the poll
     */
    public int $total_voter_count;

    /**
     * @var bool True, if the poll is closed
     */
    public bool $is_closed;

    /**
     * @var bool True, if the poll is anonymous
     */
    public bool $is_anonymous;

    /**
     * @var string Poll type, currently can be self::TYPE_*
     */
    public string $type;

    /**
     * @var bool True, if the poll allows multiple answers
     */
    public bool $allows_multiple_answers;

    /**
     * @var int|null 0-based identifier of the correct answer option. Available only for polls in the quiz mode,
     * which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.
     */
    public ?int $correct_option_id;

    /**
     * @var string|null Text that is shown when a user chooses an incorrect answer or taps on the lamp
     * icon in a quiz-style poll, 0-200 characters
     */
    public ?string $explanation;

    /**
     * @var MessageEntity[]|null Special entities like usernames, URLs, bot commands, etc. that appear
     * in the explanation
     */
    public ?array $explanation_entities = null;

    /**
     * @var int|null Amount of time in seconds the poll will be active after creation
     */
    public ?int $open_period;

    /**
     * @var int|null Point in time (Unix timestamp) when the poll will be automatically closed
     */
    public ?int $close_date;

    /**
     * Poll constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (!self::checkType($data['type'])) {
            throw new Error("Unknown poll type: {$data['type']}");
        }

        $this->id = $data['id'];
        $this->question = $data['question'];

        foreach ($data['options'] as $item) {
            $this->options[] = $item instanceof PollOption ? $item : new PollOption($item);
        }

        $this->total_voter_count = $data['total_voter_count'];
        $this->is_closed = $data['is_closed'];
        $this->is_anonymous = $data['is_anonymous'];
        $this->type = $data['type'];
        $this->allows_multiple_answers = $data['allows_multiple_answers'];
        $this->correct_option_id = $data['correct_option_id'] ?? null;
        $this->explanation = $data['explanation'] ?? null;

        if (isset($data['explanation_entities'])) {
            $this->explanation_entities = [];
            foreach ($data['explanation_entities'] as $explanation_entity_data) {
                $this->explanation_entities[] = new MessageEntity($explanation_entity_data);
            }
        }

        $this->open_period = $data['open_period'] ?? null;
        $this->close_date = $data['close_date'] ?? null;
    }

    /**
     * @param string $type
     * @return bool
     */
    public static function checkType(string $type): bool
    {
        return $type === self::TYPE_QUIZ ||
            $type === self::TYPE_REGULAR;
    }

    /**
     * @param string $id Unique poll identifier
     * @param string $question Poll question, 1-255 characters
     * @param PollOption[] $options List of poll options
     * @param int $total_voter_count Total number of users that voted in the poll
     * @param string $type Poll type, currently can be self::TYPE_*
     * @return Poll
     */
    public static function make(string $id, string $question, array $options, int $total_voter_count,
        string $type): self
    {
        return new self([
            'id' => $id,
            'question' => $question,
            'options' => $options,
            'total_voter_count' => $total_voter_count,
            'type' => $type,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
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
