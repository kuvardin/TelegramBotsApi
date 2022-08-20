<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object represents the content of a media message to be sent. It should be one of InputMedia\*
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class InputMedia extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            InputMedia\Animation::getType() => InputMedia\Animation::makeByArray($data),
            InputMedia\Audio::getType() => InputMedia\Audio::makeByArray($data),
            InputMedia\Document::getType() => InputMedia\Document::makeByArray($data),
            InputMedia\Photo::getType() => InputMedia\Photo::makeByArray($data),
            InputMedia\Video::getType() => InputMedia\Video::makeByArray($data),
            default => throw new RuntimeException("Unknown input media type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}
