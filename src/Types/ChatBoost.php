<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about a chat boost.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatBoost extends Type
{
    /**
     * @param string $boost_id Unique identifier of the boost
     * @param int $add_date Point in time (Unix timestamp) when the chat was boosted
     * @param int $expiration_date Point in time (Unix timestamp) when the boost will automatically expire, unless
     *     the booster's Telegram Premium subscription is prolonged
     * @param ChatBoostSource $source Source of the added boost
     */
    public function __construct(
        public string $boost_id,
        public int $add_date,
        public int $expiration_date,
        public ChatBoostSource $source,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            boost_id: $data['boost_id'],
            add_date: $data['add_date'],
            expiration_date: $data['expiration_date'],
            source: ChatBoostSource::makeByArray($data['source']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'boost_id' => $this->boost_id,
            'add_date' => $this->add_date,
            'expiration_date' => $this->expiration_date,
            'source' => $this->source,
        ];
    }
}
