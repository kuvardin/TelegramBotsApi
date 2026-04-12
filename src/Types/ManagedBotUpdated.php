<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about the creation, token update, or owner update of a bot that is managed by
 * the current bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ManagedBotUpdated extends Type
{
    /**
     * @param User $user User that created the bot
     * @param User $bot Information about the bot. Token of the bot can be fetched using the method getManagedBotToken.
     */
    public function __construct(
        public User $user,
        public User $bot,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            user: User::makeByArray($data['user']),
            bot: User::makeByArray($data['bot']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'user' => $this->user,
            'bot' => $this->bot,
        ];
    }
}
