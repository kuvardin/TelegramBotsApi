<?php


namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Object of this class contains information about a poll.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Poll implements TypeInterface
{
    /**
     * @var string Unique poll identifier
     */
    public $id;

    /**
     * @var string Poll question, 1-255 characters
     */
    public $question;

    /**
     * @var PollOption[] List of poll options
     */
    public $options = [];

    /**
     * @var bool True, if the poll is closed
     */
    public $is_closed;

    /**
     * Poll constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->question = $data['question'];

        foreach ($data['options'] as $option) {
            $this->options[] = $option instanceof PollOption ? $option : new PollOption($option);
        }

        $this->is_closed = $data['is_closed'];
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        $options = [];
        foreach ($this->options as $option) {
            $options[] = $option->getRequestArray();
        }

        return [
            'id' => $this->id,
            'question' => $this->question,
            'options' => $options,
            'is_closed' => $this->is_closed,
        ];
    }

    /**
     * @param string $id
     * @param string $question
     * @param array|PollOption[] $options
     * @param bool $is_closed
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
}