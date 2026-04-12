<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about a change in the price of direct messages sent to a channel chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class DirectMessagePriceChanged extends Type
{
    /**
     * @param bool $are_direct_messages_enabled True, if direct messages are enabled for the channel chat;
     *     false otherwise
     * @param int|null $direct_message_star_count The new number of Telegram Stars that must be paid by users for each
     *     direct message sent to the channel. Does not apply to users who have been exempted by administrators.
     *     Defaults to 0.
     */
    public function __construct(
        public bool $are_direct_messages_enabled,
        public ?int $direct_message_star_count = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            are_direct_messages_enabled: $data['are_direct_messages_enabled'],
            direct_message_star_count: $data['direct_message_star_count'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'are_direct_messages_enabled' => $this->are_direct_messages_enabled,
            'direct_message_star_count' => $this->direct_message_star_count,
        ];
    }
}
