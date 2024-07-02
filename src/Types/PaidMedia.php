<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes paid media
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class PaidMedia extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            PaidMedia\Preview::getType() => PaidMedia\Preview::makeByArray($data),
            PaidMedia\Photo::getType() => PaidMedia\Photo::makeByArray($data),
            PaidMedia\Video::getType() => PaidMedia\Video::makeByArray($data),
            default => throw new RuntimeException("Unknown paid media type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}
