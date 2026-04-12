<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents the bot's description.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BotDescription extends Type
{
    /**
     * @param string $description The bot's description
     */
    public function __construct(
        public string $description,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            description: $data['description'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'description' => $this->description,
        ];
    }
}
