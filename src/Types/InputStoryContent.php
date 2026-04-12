<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes the content of a story to post. Currently, it can be one of InputStoryContent\\*
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class InputStoryContent extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            InputStoryContent\Photo::getType() => InputStoryContent\Photo::makeByArray($data),
            InputStoryContent\Video::getType() => InputStoryContent\Video::makeByArray($data),
            default => throw new RuntimeException("Unknown input story content type: {$data['type']}"),
        };
    }
}
