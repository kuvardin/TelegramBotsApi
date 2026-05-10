<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMedia;

use Kuvardin\TelegramBotsApi\Types\InputFile;
use Kuvardin\TelegramBotsApi\Types\InputMedia;
use Kuvardin\TelegramBotsApi\Types\InputPollOptionMedia;
use RuntimeException;


/**
 * Represents a sticker file to be sent.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Sticker extends InputMedia implements InputPollOptionMedia
{
    /**
     * @param InputFile|string $media File to send
     * @param string|null $emoji Emoji associated with the sticker; only for just uploaded stickers
     */
    public function __construct(
        public InputFile|string $media,
        public ?string $emoji = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'sticker';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input media type: {$data['type']}");
        }

        return new self(
            media: $data['media'],
            emoji: $data['emoji'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'media' => $this->media,
            'emoji' => $this->emoji,
        ];
    }
}





