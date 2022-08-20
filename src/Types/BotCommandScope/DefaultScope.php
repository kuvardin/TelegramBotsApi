<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\BotCommandScope;

use Kuvardin\TelegramBotsApi\Types\BotCommandScope;
use RuntimeException;

/**
 * Represents the default <a href="https://core.telegram.org/bots/api#botcommandscope">scope</a> of bot commands.
 * Default commands are used if no commands with a <a
 * href="https://core.telegram.org/bots/api#determining-list-of-commands">narrower scope</a> are specified for the
 * user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class DefaultScope extends BotCommandScope
{
    public static function getType(): string
    {
        return 'default';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong type: {$data['type']}");
        }

        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
        ];
    }
}
