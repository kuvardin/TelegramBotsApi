<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes an inline message sent by a guest bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SentGuestMessage extends Type
{
    /**
     * @param string $inline_message_id Identifier of the sent inline message
     */
    public function __construct(
        public string $inline_message_id,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            inline_message_id: $data['inline_message_id'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'inline_message_id' => $this->inline_message_id,
        ];
    }
}





