<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Exceptions\Error;

/**
 * Represents a result of an inline query that was chosen by the user and sent to their chat partner.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChosenInlineResult implements TypeInterface
{
    /**
     * @var string The unique identifier for the result that was chosen
     */
    public string $result_id;

    /**
     * @var User The user that chose the result
     */
    public User $from;

    /**
     * @var Location|null Sender location, only for bots that require user location
     */
    public ?Location $location = null;

    /**
     * @var string|null Identifier of the sent inline message. Available only if there is an inline keyboard
     * attached to the message. Will be also received in callback queries and can be used to edit the message.
     */
    public ?string $inline_message_id = null;

    /**
     * @var string The query that was used to obtain the result
     */
    public string $query;

    /**
     * ChosenInlineResult constructor.
     *
     * @param array $data
     * @throws Error
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->result_id = $data['result_id'];
        $this->from = $data['from'] instanceof User
            ? $data['from']
            : new User($data['from']);

        if (isset($data['location'])) {
            $this->location = $data['location'] instanceof Location
                ? $data['location']
                : new Location($data['location']);
        }

        if (isset($data['inline_message_id'])) {
            $this->inline_message_id = $data['inline_message_id'];
        }

        $this->query = $data['query'];
    }

    /**
     * @param string $result_id The unique identifier for the result that was chosen
     * @param User $from The user that chose the result
     * @param string $query The query that was used to obtain the result
     * @return ChosenInlineResult
     * @throws Error
     * @throws Error
     */
    public static function make(string $result_id, User $from, string $query): self
    {
        return new self([
            'result_id' => $result_id,
            'from' => $from,
            'query' => $query,
        ]);
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
}
