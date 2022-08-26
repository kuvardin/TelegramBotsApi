<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a bot command.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BotCommand extends Type
{
    /**
     * @param string $command Text of the command; 1-32 characters. Can contain only lowercase English letters, digits
     *     and underscores.
     * @param string $description Description of the command; 1-256 characters.
     */
    public function __construct(
        public string $command,
        public string $description,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            command: $data['command'],
            description: $data['description'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'command' => $this->command,
            'description' => $this->description,
        ];
    }
}
