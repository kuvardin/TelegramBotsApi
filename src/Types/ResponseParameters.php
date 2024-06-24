<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes why a request was unsuccessful.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ResponseParameters extends Type
{
    /**
     * @param int|null $migrate_to_chat_id The group has been migrated to a supergroup with the specified identifier.
     *     This number may have more than 32 significant bits and some programming languages may have difficulty/silent
     *     defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or
     *     double-precision float type are safe for storing this identifier.
     * @param int|null $retry_after In case of exceeding flood control, the number of seconds left to wait before the
     *     request can be repeated
     */
    public function __construct(
        public ?int $migrate_to_chat_id = null,
        public ?int $retry_after = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            migrate_to_chat_id: $data['migrate_to_chat_id'] ?? null,
            retry_after: $data['retry_after'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'migrate_to_chat_id' => $this->migrate_to_chat_id,
            'retry_after' => $this->retry_after,
        ];
    }
}
