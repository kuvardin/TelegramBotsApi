<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\BotCommandScope;

use Kuvardin\TelegramBotsApi\Types\BotCommandScope;
use RuntimeException;

/**
 * Represents the scope of bot commands, covering all administrators of a specific group or supergroup chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatAdministrators extends BotCommandScope
{
    /**
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup (in the
     *     format "&#64;supergroupusername"). Channel direct messages chats and channel chats aren't supported.
     */
    public function __construct(
        public int|string $chat_id,
    )
    {

    }

    public static function getType(): string
    {
        return 'chat_administrators';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong type: {$data['type']}");
        }

        return new self(
            chat_id: $data['chat_id'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'chat_id' => $this->chat_id,
        ];
    }
}
