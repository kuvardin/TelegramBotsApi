<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\BotCommandScope;

use Kuvardin\TelegramBotsApi\Types\BotCommandScope;
use RuntimeException;

/**
 * Represents the <a href="https://core.telegram.org/bots/api#botcommandscope">scope</a> of bot commands, covering a
 * specific member of a group or supergroup chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatMember extends BotCommandScope
{
    /**
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup (in the
     *     format <code>@supergroupusername</code>)
     * @param int $user_id Unique identifier of the target user
     */
    public function __construct(
        public int|string $chat_id,
        public int $user_id,
    )
    {

    }

    public static function getType(): string
    {
        return 'chat_member';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong type: {$data['type']}");
        }

        return new self(
            chat_id: $data['chat_id'],
            user_id: $data['user_id'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'chat_id' => $this->chat_id,
            'user_id' => $this->user_id,
        ];
    }
}
