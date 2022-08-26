<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\MenuButton;

use Kuvardin\TelegramBotsApi\Types\MenuButton;
use RuntimeException;

/**
 * Represents a menu button, which opens the bot's list of commands.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Commands extends MenuButton
{
    public static function getType(): string
    {
        return 'commands';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong menu button type: {$data['type']}");
        }

        return new self;
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
        ];
    }
}
