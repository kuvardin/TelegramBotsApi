<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * A placeholder, currently holds no information. Use BotFather to set up your game.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CallbackGame extends Type
{
    public static function makeByArray(array $data): self
    {
        return new self();
    }

    public function getRequestData(): array
    {
        return [];
    }
}
