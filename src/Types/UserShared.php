<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about the user whose identifier was shared with the bot using a
 * KeyboardButtonRequestUser button.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UserShared extends Type
{
    /**
     * @param int $request_id Identifier of the request
     * @param int $user_id Identifier of the shared user. This number may have more than 32 significant bits and some
     *     programming languages may have difficulty/silent defects in interpreting it. But it has at most 52
     *     significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     *     The bot may not have access to the user and could be unable to use this identifier, unless the user is
     *     already known to the bot by some other means.
     */
    public function __construct(
        public int $request_id,
        public int $user_id,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            request_id: $data['request_id'],
            user_id: $data['user_id'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'request_id' => $this->request_id,
            'user_id' => $this->user_id,
        ];
    }
}
