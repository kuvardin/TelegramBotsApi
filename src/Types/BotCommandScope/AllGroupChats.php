<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\BotCommandScope;

use Kuvardin\TelegramBotsApi\Types\BotCommandScope;
use RuntimeException;

/**
 * Represents the <a href="https://core.telegram.org/bots/api#botcommandscope">scope</a> of bot commands, covering all
 * group and supergroup chats.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class AllGroupChats extends BotCommandScope
{
    public static function getType(): string
    {
        return 'all_group_chats';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong type: {$data['type']}");
        }

        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
        ];
    }
}
