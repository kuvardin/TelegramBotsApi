<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * Describes the type of a clickable area on a story. Currently, it can be one of StoryAreaType\\*
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class StoryAreaType extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            StoryAreaType\Link::getType() => StoryAreaType\Link::makeByArray($data),
            StoryAreaType\Location::getType() => StoryAreaType\Location::makeByArray($data),
            StoryAreaType\SuggestedReaction::getType() => StoryAreaType\SuggestedReaction::makeByArray($data),
            StoryAreaType\UniqueGift::getType() => StoryAreaType\UniqueGift::makeByArray($data),
            StoryAreaType\Weather::getType() => StoryAreaType\Weather::makeByArray($data),
            default => throw new RuntimeException("Unknown store area types type: {$data['type']}"),
        };
    }
}
