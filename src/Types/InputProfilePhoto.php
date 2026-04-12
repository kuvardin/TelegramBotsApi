<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes a profile photo to set. It should be one of InputProfilePhoto\\*
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class InputProfilePhoto extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            InputProfilePhoto\Animated::getType() => InputProfilePhoto\Animated::makeByArray($data),
            InputProfilePhoto\StaticPhoto::getType() => InputProfilePhoto\StaticPhoto::makeByArray($data),
            default => throw new RuntimeException("Unknown profile photo type: {$data['type']}"),
        };
    }
}
