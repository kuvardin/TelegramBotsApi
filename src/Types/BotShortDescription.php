<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents the bot&#39;s short description.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BotShortDescription extends Type
{
    /**
     * @param string $short_description The bot's short description
     */
    public function __construct(
        public string $short_description,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            short_description: $data['short_description'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'short_description' => $this->short_description,
        ];
    }
}
