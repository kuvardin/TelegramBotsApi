<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about a change in the price of paid messages within a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PaidMessagePriceChanged extends Type
{
    /**
     * @param int $paid_message_star_count The new number of Telegram Stars that must be paid by non-administrator users
     *     of the supergroup chat for each sent message
     */
    public function __construct(
        public int $paid_message_star_count,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            paid_message_star_count: $data['paid_message_star_count'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'paid_message_star_count' => $this->paid_message_star_count,
        ];
    }
}
