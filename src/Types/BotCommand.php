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
     * @param bool|null $is_ephemeral True, if the command sends an ephemeral message, which can be seen only by the
     *     sender of the message and the bot
     */
    public function __construct(
        public string $command,
        public string $description,
        public ?bool $is_ephemeral = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            command: $data['command'],
            description: $data['description'],
            is_ephemeral: $data['is_ephemeral'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'command' => $this->command,
            'description' => $this->description,
            'is_ephemeral' => $this->is_ephemeral,
        ];
    }
}
