<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * This object represents a bot command.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BotCommand implements TypeInterface
{
    /**
     * @var string Text of the command, 1-32 characters. Can contain only lowercase English letters,
     * digits and underscores.
     */
    public string $command;

    /**
     * @var string  Description of the command, 3-256 characters.
     */
    public string $description;

    /**
     * BotCommand constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->command = $data['command'];
        $this->description = $data['description'];
    }

    /**
     * @param string $command Text of the command, 1-32 characters. Can contain only lowercase English letters,
     * digits and underscores.
     * @param string $description Description of the command, 3-256 characters.
     * @return static
     */
    public static function make(string $command, string $description): self
    {
        return new self([
            'command' => $command,
            'description' => $description,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'command' => $this->command,
            'description' => $this->description,
        ];
    }
}
