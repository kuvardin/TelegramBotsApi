<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes the source of a chat boost.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class ChatBoostSource extends Type
{
    abstract public static function getSource(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['source']) {
            ChatBoostSource\GiftCode::getSource() => ChatBoostSource\GiftCode::makeByArray($data),
            ChatBoostSource\Giveaway::getSource() => ChatBoostSource\Giveaway::makeByArray($data),
            ChatBoostSource\Premium::getSource() => ChatBoostSource\Premium::makeByArray($data),
            default => throw new RuntimeException("Unknown chat boost source: {$data['source']}"),
        };
    }
}
