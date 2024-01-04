<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes the type of a reaction.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class ReactionType extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            ReactionType\Emoji::getType() => ReactionType\Emoji::makeByArray($data),
            ReactionType\CustomEmoji::getType() => ReactionType\CustomEmoji::makeByArray($data),
            default => throw new RuntimeException("Unknown reaction type: {$data['type']}"),
        };
    }
}