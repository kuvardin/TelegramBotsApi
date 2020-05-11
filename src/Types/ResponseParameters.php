<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * Contains information about why a request was unsuccessful.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ResponseParameters implements TypeInterface
{
    /**
     * @var int|null The group has been migrated to a supergroup with the specified identifier. This number may be
     * greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it.
     * But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for
     * storing this identifier.
     */
    public ?int $migrate_to_chat_id = null;

    /**
     * @var int|null In case of exceeding flood control, the number of seconds left to wait before the request can be
     *     repeated
     */
    public ?int $retry_after = null;

    /**
     * ResponseParameters constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (isset($data['migrate_to_chat_id'])) {
            $this->migrate_to_chat_id = $data['migrate_to_chat_id'];
        }

        if (isset($data['retry_after'])) {
            $this->retry_after = $data['retry_after'];
        }
    }

    /**
     * @return static
     */
    public static function make(): self
    {
        return new self([
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'migrate_to_chat_id' => $this->migrate_to_chat_id,
            'retry_after' => $this->retry_after,
        ];
    }
}
