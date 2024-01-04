<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes a message that can be inaccessible to the bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class MaybeInaccessibleMessage extends Type
{
    public static function makeByArray(array $data): self
    {
        return $data['date'] === 0
            ? InaccessibleMessage::makeByArray($data)
            : Message::makeByArray($data);
    }
}
