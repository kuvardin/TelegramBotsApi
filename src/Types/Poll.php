<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * This object contains information about a poll.
 *
 * @package TelegramBotsApi
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
     * @var int 0-based identifier of the correct answer option. Available only for polls in the quiz mode,
     * which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.
     */
    public ?int $correct_option_id = null;

    /**
     * Poll constructor.
     *
     * @param array $data
     * @throws Error
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

        $this->total_voter_count = $data['$total_voter_count'];
        $this->is_closed = $data['is_closed'];
        $this->is_anonymous = $data['is_anonymous'];
        $this->type = $data['type'];
        $this->allows_multiple_answers = $data['allows_multiple_answers'];

        if (isset($data['correct_option_id'])) {
            $this->correct_option_id = $data['$correct_option_id'];
        }
    }

    /**
     * @param string $id Unique poll identifier
     * @param string $question Poll question, 1-255 characters
     * @param PollOption[] $options List of poll options
     * @param bool $is_closed True, if the poll is closed
     * @return Poll
     * @throws Error
     */
    public static function make(string $id, string $question, array $options, bool $is_closed): self
    {
        return new self([
            'id' => $id,
            'question' => $question,
            'options' => $options,
            'is_closed' => $is_closed,
        ]);
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
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'options' => $this->options,
            'is_closed' => $this->is_closed,
        ];
    }
}