<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Represents a result of an inline query that was chosen by the user and sent to their chat partner.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChosenInlineResult extends Type
{
    /**
     * @param string $result_id The unique identifier for the result that was chosen
     * @param User $from The user that chose the result
     * @param string $query The query that was used to obtain the result
     * @param Location|null $location Sender location, only for bots that require user location
     * @param string|null $inline_message_id Identifier of the sent inline message. Available only if there is an <a
     *     href="https://core.telegram.org/bots/api#inlinekeyboardmarkup">inline keyboard</a> attached to the message.
     *     Will be also received in <a href="https://core.telegram.org/bots/api#callbackquery">callback queries</a> and
     *     can be used to <a href="https://core.telegram.org/bots/api#updating-messages">edit</a> the message.
     */
    public function __construct(
        public string $result_id,
        public User $from,
        public string $query,
        public ?Location $location = null,
        public ?string $inline_message_id = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            result_id: $data['result_id'],
            from: User::makeByArray($data['from']),
            query: $data['query'],
            location: isset($data['location'])
                ? Location::makeByArray($data['location'])
                : null,
            inline_message_id: $data['inline_message_id'] ?? null,
        );
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
