<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents the bot&#39;s name.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BotName extends Type
{
    /**
     * @param string $name The bot's name
     */
    public function __construct(
        public string $name,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            name: $data['name'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
