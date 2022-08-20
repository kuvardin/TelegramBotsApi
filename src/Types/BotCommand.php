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
     * @var string $command Text of the command; 1-32 characters. Can contain only lowercase English letters, digits
     *     and underscores.
     */
    public string $command;

    /**
     * @var string $description Description of the command; 1-256 characters.
     */
    public string $description;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->command = $data['command'];
        $result->description = $data['description'];
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'command' => $this->command,
            'description' => $this->description,
        ];
    }
}
