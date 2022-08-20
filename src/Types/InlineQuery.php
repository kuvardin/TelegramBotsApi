<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

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
     * @var string $id Unique identifier for this query
     */
    public string $id;

    /**
     * @var User $from Sender
     */
    public User $from;

    /**
     * @var string $query Text of the query (up to 256 characters)
     */
    public string $query;

    /**
     * @var string $offset Offset of the results to be returned, can be controlled by the bot
     */
    public string $offset;

    /**
     * @var string|null $chat_type Type of the chat, from which the inline query was sent. Can be either “sender” for a
     *     private chat with the inline query sender, “private”, “group”, “supergroup”, or “channel”. The chat type
     *     should be always known for requests sent from official clients and most third-party clients, unless the
     *     request was sent from a secret chat
     */
    public ?string $chat_type = null;

    /**
     * @var Location|null $location Sender location, only for bots that request user location
     */
    public ?Location $location = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->id = $data['id'];
        $result->from = User::makeByArray($data['from']);
        $result->query = $data['query'];
        $result->offset = $data['offset'];
        $result->chat_type = $data['chat_type'] ?? null;
        $result->location = isset($data['location'])
            ? Location::makeByArray($data['location'])
            : null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'from' => $this->from,
            'query' => $this->query,
            'offset' => $this->offset,
            'chat_type' => $this->chat_type,
            'location' => $this->location,
        ];
    }
}
