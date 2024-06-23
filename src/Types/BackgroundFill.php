<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes the way a background is filled based on the selected colors.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class BackgroundFill extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            BackgroundFill\FreeformGradient::getType() => BackgroundFill\FreeformGradient::makeByArray($data),
            BackgroundFill\Gradient::getType() => BackgroundFill\Gradient::makeByArray($data),
            BackgroundFill\Solid::getType() => BackgroundFill\Solid::makeByArray($data),
            default => throw new RuntimeException("Unknown background fill type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}
