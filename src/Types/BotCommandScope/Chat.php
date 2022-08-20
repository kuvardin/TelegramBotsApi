<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\BotCommandScope;

use Kuvardin\TelegramBotsApi\Types\BotCommandScope;
use RuntimeException;

/**
 * Represents the <a href="https://core.telegram.org/bots/api#botcommandscope">scope</a> of bot commands, covering a
 * specific chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Chat extends BotCommandScope
{
    public static function getType(): string
    {
        return 'chat';
    }

    /**
     * @var int|string $chat_id Unique identifier for the target chat or username of the target supergroup (in the
     *     format <code>@supergroupusername</code>)
     */
    public int|string $chat_id;

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong type: {$data['type']}");
        }

        $result->chat_id = $data['chat_id'];
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'chat_id' => $this->chat_id,
        ];
    }
}
