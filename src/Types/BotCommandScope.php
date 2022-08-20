<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object represents the scope to which bot commands are applied. Currently, the following 7 scopes are supported:
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class BotCommandScope extends Type
{
    abstract static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            BotCommandScope\AllChatAdministrators::getType() =>
            BotCommandScope\AllChatAdministrators::makeByArray($data),
            BotCommandScope\AllGroupChats::getType() => BotCommandScope\AllGroupChats::makeByArray($data),
            BotCommandScope\AllPrivateChats::getType() => BotCommandScope\AllPrivateChats::makeByArray($data),
            BotCommandScope\Chat::getType() => BotCommandScope\Chat::makeByArray($data),
            BotCommandScope\ChatAdministrators::getType() => BotCommandScope\ChatAdministrators::makeByArray($data),
            BotCommandScope\ChatMember::getType() => BotCommandScope\ChatMember::makeByArray($data),
            BotCommandScope\DefaultScope::getType() => BotCommandScope\DefaultScope::makeByArray($data),
            default => throw new RuntimeException("Unknown bot command scope type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}
