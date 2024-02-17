<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a service message about a user boosting a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatBoostAdded extends Type
{
    /**
     * @param int $boost_count Number of boosts added by the user
     */
    public function __construct(
        public int $boost_count,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            boost_count: $data['boost_count'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'boost_count' => $this->boost_count,
        ];
    }
}
