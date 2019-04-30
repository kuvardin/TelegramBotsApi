<?php


namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Object of this class contains information about one answer option in a poll.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class PollOption implements TypeInterface
{
    /**
     * @var string Option text, 1-100 characters
     */
    public $text;

    /**
     * @var int Number of users that voted for this option
     */
    public $voter_count;

    /**
     * PollOption constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->text = $data['text'];
        $this->voter_count = $data['voter_count'];
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'text' => $this->text,
            'voter_count' => $this->voter_count,
        ];
    }

    /**
     * @param string $text
     * @param int $voter_count
     * @return PollOption
     */
    public static function make(string $text, int $voter_count): self
    {
        return new self([
            'text' => $text,
            'voter_count' => $voter_count,
        ]);
    }
}