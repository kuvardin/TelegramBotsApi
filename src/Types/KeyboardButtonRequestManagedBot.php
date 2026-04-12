<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object defines the parameters for the creation of a managed bot. Information about the created bot will be
 * shared with the bot using the update "managed_bot" and a Message with the field "managed_bot_created".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class KeyboardButtonRequestManagedBot extends Type
{
    /**
     * @param int $request_id Signed 32-bit identifier of the request. Must be unique within the message
     * @param string|null $suggested_name Suggested name for the bot
     * @param string|null $suggested_username Suggested username for the bot
     */
    public function __construct(
        public int $request_id,
        public ?string $suggested_name = null,
        public ?string $suggested_username = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            request_id: $data['request_id'],
            suggested_name: $data['suggested_name'] ?? null,
            suggested_username: $data['suggested_username'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'request_id' => $this->request_id,
            'suggested_name' => $this->suggested_name,
            'suggested_username' => $this->suggested_username,
        ];
    }
}
