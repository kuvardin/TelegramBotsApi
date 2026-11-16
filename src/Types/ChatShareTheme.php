<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes the theme of the screen for sharing a link to a user or a chat
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class ChatShareTheme extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            ChatShareTheme\Emoji::getType() => ChatShareTheme\Emoji::makeByArray($data),
            ChatShareTheme\UniqueGift::getType() => ChatShareTheme\UniqueGift::makeByArray($data),
            default => throw new RuntimeException("Unknown chat share theme type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}
