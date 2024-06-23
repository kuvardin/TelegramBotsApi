<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes the type of a background.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class BackgroundType extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            BackgroundType\ChatTheme::getType() => BackgroundType\ChatTheme::makeByArray($data),
            BackgroundType\Fill::getType() => BackgroundType\Fill::makeByArray($data),
            BackgroundType\Pattern::getType() => BackgroundType\Pattern::makeByArray($data),
            BackgroundType\Wallpaper::getType() => BackgroundType\Wallpaper::makeByArray($data),
            default => throw new RuntimeException("Unknown background type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}
