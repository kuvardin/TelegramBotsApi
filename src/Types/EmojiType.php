<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes an emoji.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class EmojiType extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            EmojiType\CustomEmoji::getType() => EmojiType\CustomEmoji::makeByArray($data),
            EmojiType\Emoji::getType() => EmojiType\Emoji::makeByArray($data),
            default => throw new RuntimeException("Unknown emoji type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}

