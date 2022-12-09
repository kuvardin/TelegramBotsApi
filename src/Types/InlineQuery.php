<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Enums\InlineQueryChatType;
use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents an incoming inline query. When the user sends an empty query, your bot could return some
 * default or trending results.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InlineQuery extends Type
{
    /**
     * @param string $id Unique identifier for this query
     * @param User $from Sender
     * @param string $query Text of the query (up to 256 characters)
     * @param string $offset Offset of the results to be returned, can be controlled by the bot
     * @param string|null $inline_query_chat_type_value Type of the chat, from which the inline query was sent. Can be
     *     one of Enums\InlineQueryChatType. Can be either “sender” for a private chat with the inline query sender,
     *     “private”, “group”, “supergroup”, or “channel”. The chat type should be always known for requests sent from
     *     official clients and most third-party clients, unless the request was sent from a secret chat
     * @param Location|null $location Sender location, only for bots that request user location
     */
    public function __construct(
        public string $id,
        public User $from,
        public string $query,
        public string $offset,
        public ?string $inline_query_chat_type_value = null,
        public ?Location $location = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            from: User::makeByArray($data['from']),
            query: $data['query'],
            offset: $data['offset'],
            inline_query_chat_type_value: $data['chat_type'] ?? null,
            location: isset($data['location'])
                ? Location::makeByArray($data['location'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'from' => $this->from,
            'query' => $this->query,
            'offset' => $this->offset,
            'chat_type' => $this->inline_query_chat_type_value,
            'location' => $this->location,
        ];
    }

    /**
     * @return InlineQueryChatType|null Returns <em>Null</em> if inline query chat type value is null or unknown.
     */
    public function getInlineQueryChatType(): ?InlineQueryChatType
    {
        return $this->inline_query_chat_type_value === null
            ? null
            : InlineQueryChatType::tryFrom($this->inline_query_chat_type_value);
    }
}
