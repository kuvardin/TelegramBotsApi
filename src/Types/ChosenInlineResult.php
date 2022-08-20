<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Represents a <a href="https://core.telegram.org/bots/api#inlinequeryresult">result</a> of an inline query that was
 * chosen by the user and sent to their chat partner.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChosenInlineResult extends Type
{
    /**
     * @var string $result_id The unique identifier for the result that was chosen
     */
    public string $result_id;

    /**
     * @var User $from The user that chose the result
     */
    public User $from;

    /**
     * @var Location|null $location Sender location, only for bots that require user location
     */
    public ?Location $location = null;

    /**
     * @var string|null $inline_message_id Identifier of the sent inline message. Available only if there is an <a
     *     href="https://core.telegram.org/bots/api#inlinekeyboardmarkup">inline keyboard</a> attached to the message.
     *     Will be also received in <a href="https://core.telegram.org/bots/api#callbackquery">callback queries</a> and
     *     can be used to <a href="https://core.telegram.org/bots/api#updating-messages">edit</a> the message.
     */
    public ?string $inline_message_id = null;

    /**
     * @var string $query The query that was used to obtain the result
     */
    public string $query;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->result_id = $data['result_id'];
        $result->from = User::makeByArray($data['from']);
        $result->location = isset($data['location'])
            ? Location::makeByArray($data['location'])
            : null;
        $result->inline_message_id = $data['inline_message_id'] ?? null;
        $result->query = $data['query'];
        return $result;
    }

    public function getRequestData(): array
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
