<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes the paid media to be sent
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class InputPaidMedia extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            InputPaidMedia\Video::getType() => InputPaidMedia\Video::makeByArray($data),
            InputPaidMedia\Photo::getType() => InputPaidMedia\Photo::makeByArray($data),
            default => throw new RuntimeException("Unknown input media type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}
