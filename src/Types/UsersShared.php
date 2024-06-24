<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about the users whose identifiers were shared with the bot using a
 * KeyboardButtonRequestUsers button.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UsersShared extends Type
{
    /**
     * @param int $request_id Identifier of the request
     * @param SharedUser[] $users Information about users shared with the bot.
     */
    public function __construct(
        public int $request_id,
        public array $users,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            request_id: $data['request_id'],
            users: array_map(
                static fn(array $shared_user_data) => SharedUser::makeByArray($shared_user_data),
                $data['users'],
            ),
        );
    }

    public function getRequestData(): array
    {
        return [
            'request_id' => $this->request_id,
            'users' => $this->users,
        ];
    }
}
