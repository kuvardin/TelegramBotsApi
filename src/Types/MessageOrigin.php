<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes the origin of a message.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class MessageOrigin extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            MessageOrigin\Channel::getType() => MessageOrigin\Channel::makeByArray($data),
            MessageOrigin\Chat::getType() => MessageOrigin\Chat::makeByArray($data),
            MessageOrigin\HiddenUser::getType() => MessageOrigin\HiddenUser::makeByArray($data),
            MessageOrigin\User::getType() => MessageOrigin\User::makeByArray($data),
            default => throw new RuntimeException("Unknown message origin type: {$data['type']}"),
        };
    }
}