<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a unique message identifier.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class MessageId extends Type
{
    /**
     * @param int $message_id Unique message identifier
     */
    public function __construct(
        public int $message_id,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            message_id: $data['message_id'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'message_id' => $this->message_id,
        ];
    }
}
