<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichTextModel;

use Kuvardin\TelegramBotsApi\Types\RichTextModel;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichText;

/**
 * A bot command.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BotCommand extends RichTextModel
{
    /**
     * @param RichText $text The text
     * @param string $bot_command The bot command
     */
    public function __construct(
        public RichText $text,
        public string $bot_command,
    )
    {

    }

    public static function getType(): string
    {
        return 'bot_command';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich text type: {$data['type']}");
        }

        return new self(
            text: RichText::makeByInput($data['text']),
            bot_command: $data['bot_command'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'text' => $this->text,
            'bot_command' => $this->bot_command,
        ];
    }
}





