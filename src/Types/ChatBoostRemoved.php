<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a boost removed from a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatBoostRemoved extends Type
{
    /**
     * @param Chat $chat Chat which was boosted
     * @param string $boost_id Unique identifier of the boost
     * @param int $remove_date Point in time (Unix timestamp) when the boost was removed
     * @param ChatBoostSource $source Source of the removed boost
     */
    public function __construct(
        public Chat $chat,
        public string $boost_id,
        public int $remove_date,
        public ChatBoostSource $source,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            chat: Chat::makeByArray($data['chat']),
            boost_id: $data['boost_id'],
            remove_date: $data['remove_date'],
            source: ChatBoostSource::makeByArray($data['source']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'chat' => $this->chat,
            'boost_id' => $this->boost_id,
            'remove_date' => $this->remove_date,
            'source' => $this->source,
        ];
    }
}
