<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes a gift received and owned by a user or a chat. Currently, it can be one of OwnedGift\\*
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class OwnedGift extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            OwnedGift\Regular::getType() => OwnedGift\Regular::makeByArray($data),
            OwnedGift\Unique::getType() => OwnedGift\Unique::makeByArray($data),
            default => throw new RuntimeException("Unknown owned gift type: {$data['type']}"),
        };
    }
}
