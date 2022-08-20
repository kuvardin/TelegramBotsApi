<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Contains information about why a request was unsuccessful.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ResponseParameters extends Type
{
    /**
     * @var int|null $migrate_to_chat_id The group has been migrated to a supergroup with the specified identifier.
     *     This number may have more than 32 significant bits and some programming languages may have difficulty/silent
     *     defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or
     *     double-precision float type are safe for storing this identifier.
     */
    public ?int $migrate_to_chat_id = null;

    /**
     * @var int|null $retry_after In case of exceeding flood control, the number of seconds left to wait before the
     *     request can be repeated
     */
    public ?int $retry_after = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->migrate_to_chat_id = $data['migrate_to_chat_id'] ?? null;
        $result->retry_after = $data['retry_after'] ?? null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'migrate_to_chat_id' => $this->migrate_to_chat_id,
            'retry_after' => $this->retry_after,
        ];
    }
}
