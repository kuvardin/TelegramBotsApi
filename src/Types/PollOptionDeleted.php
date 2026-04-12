<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about an option deleted from a poll.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PollOptionDeleted extends Type
{
    /**
     * @param string $option_persistent_id Unique identifier of the deleted option
     * @param string $option_text Option text
     * @param MaybeInaccessibleMessage|null $poll_message Message containing the poll from which the option was
     *     deleted, if known. Note that the Message object in this field will not contain the "reply_to_message" field
     *     even if it itself is a reply.
     * @param MessageEntity[]|null $option_text_entities Special entities that appear in the "option_text"
     */
    public function __construct(
        public string $option_persistent_id,
        public string $option_text,
        public MaybeInaccessibleMessage|null $poll_message = null,
        public array|null $option_text_entities = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            option_persistent_id: $data['option_persistent_id'],
            option_text: $data['option_text'],
            poll_message: isset($data['poll_message'])
                ? MaybeInaccessibleMessage::makeByArray($data['poll_message'])
                : null,
            option_text_entities: isset($data['option_text_entities'])
                ? array_map(
                    static fn(array $entity_data) => MessageEntity::makeByArray($entity_data),
                    $data['option_text_entities'],
                )
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'option_persistent_id' => $this->option_persistent_id,
            'option_text' => $this->option_text,
            'poll_message' => $this->poll_message,
            'option_text_entities' => $this->option_text_entities,
        ];
    }
}
