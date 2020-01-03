<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * This object contains information about a poll.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Poll implements TypeInterface
{
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
     * @var bool True, if the poll is closed
     */
    public bool $is_closed;

    /**
     * Poll constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->question = $data['question'];

        foreach ($data['options'] as $item) {
            $this->options[] = $item instanceof PollOption ? $item : new PollOption($item);
        }

        $this->is_closed = $data['is_closed'];
    }

    /**
     * @param string $id Unique poll identifier
     * @param string $question Poll question, 1-255 characters
     * @param PollOption[] $options List of poll options
     * @param bool $is_closed True, if the poll is closed
     * @return Poll
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