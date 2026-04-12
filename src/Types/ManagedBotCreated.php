<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about the bot that was created to be managed by the current bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ManagedBotCreated extends Type
{
    /**
     * @param User $bot Information about the bot. The bot's token can be fetched using the method getManagedBotToken.
     */
    public function __construct(
        public User $bot,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            bot: User::makeByArray($data['bot']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'bot' => $this->bot,
        ];
    }
}
