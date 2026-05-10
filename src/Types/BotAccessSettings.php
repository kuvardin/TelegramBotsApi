<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes the access settings of a bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BotAccessSettings extends Type
{
    /**
     * @param bool $is_access_restricted True, if only selected users can access the bot. The bot's owner can always
     *     access it.
     * @param User[]|null $added_users The list of other users who have access to the bot if the access is restricted
     */
    public function __construct(
        public bool $is_access_restricted,
        public ?array $added_users = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            is_access_restricted: $data['is_access_restricted'],
            added_users: isset($data['added_users'])
                ? array_map(
                    static fn(array $added_users_data) => User::makeByArray($added_users_data),
                    $data['added_users'],
                )
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'is_access_restricted' => $this->is_access_restricted,
            'added_users' => $this->added_users,
        ];
    }
}





