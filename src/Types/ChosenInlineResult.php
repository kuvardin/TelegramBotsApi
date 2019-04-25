<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Represents a result of an inline query that was chosen by the user and sent to their chat partner.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class ChosenInlineResult implements TypeInterface
{

    /**
     * @var string The unique identifier for the result that was chosen
     */
    public $result_id;

    /**
     * @var User The user that chose the result
     */
    public $from;

    /**
     * @var Location|null Sender location, only for bots that require user location
     */
    public $location;

    /**
     * @var string|null Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message. Will be also received in callback queries and can be used to edit the message.
     */
    public $inline_message_id;

    /**
     * @var string The query that was used to obtain the result
     */
    public $query;

    /**
     * ChosenInlineResult constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->result_id = $data['result_id'];
        $this->from = $data['from'] instanceof User ? $data['from'] : new User($data['from']);

        if (isset($data['location'])) {
            $this->location = $data['location'] instanceof Location ? $data['location'] : new Location($data['location']);
        }

        $this->inline_message_id = $data['inline_message_id'] ?? null;
        $this->query = $data['query'];
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'result_id' => $this->result_id,
            'from' => $this->from,
            'location' => $this->location,
            'inline_message_id' => $this->inline_message_id,
            'query' => $this->query,
        ];
    }

    /**
     * @param string $result_id
     * @param User $from
     * @param string $query
     * @return ChosenInlineResult
     */
    public static function make(string $result_id, User $from, string $query): self
    {
        return new self([
            'result_id' => $result_id,
            'from' => $from,
            'query' => $query,
        ]);
    }
}