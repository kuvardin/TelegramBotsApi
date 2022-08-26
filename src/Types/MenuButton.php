<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes the bot's menu button in a private chat. It should be one of MenuButton\*
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class MenuButton extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            MenuButton\Commands::getType() => MenuButton\Commands::makeByArray($data),
            MenuButton\DefaultButton::getType() => MenuButton\DefaultButton::makeByArray($data),
            MenuButton\WebApp::getType() => MenuButton\WebApp::makeByArray($data),
            default => throw new RuntimeException("Unknown menu button type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}
