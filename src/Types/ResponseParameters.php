<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Contains information about why a request was unsuccessful.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class ResponseParameters implements TypeInterface
{
    /**
     * @var int|null The group has been migrated to a supergroup with the specified identifier. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
     */
    public $migrate_to_chat_id;

    /**
     * @var int|null In case of exceeding flood control, the number of seconds left to wait before the request can be repeated
     */
    public $retry_after;

    /**
     * ResponseParameters constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->migrate_to_chat_id = $data['migrate_to_chat_id'];
        $this->retry_after = $data['retry_after'];
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

    /**
     * @return ResponseParameters
     */
    public static function make(): self
    {
        return new self([

        ]);
    }
}