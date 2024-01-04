<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about the users whose identifiers were shared with the bot using
 * a KeyboardButtonRequestUsers button.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UsersShared extends Type
{
    /**
     * @param int $request_id Identifier of the request
     * @param int[] $user_ids Identifiers of the shared users. These numbers may have more than 32 significant bits and
     *     some programming languages may have difficulty/silent defects in interpreting them. But they have at most 52
     *     significant bits, so 64-bit integers or double-precision float types are safe for storing these identifiers.
     *     The bot may not have access to the users and could be unable to use these identifiers, unless the users are
     *     already known to the bot by some other means.
     */
    public function __construct(
        public int $request_id,
        public array $user_ids,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            request_id: $data['request_id'],
            user_ids: $data['user_ids'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'request_id' => $this->request_id,
            'user_ids' => $this->user_ids,
        ];
    }
}
