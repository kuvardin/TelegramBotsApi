<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ChatShareTheme;

use Kuvardin\TelegramBotsApi\Types\ChatShareTheme;
use Kuvardin\TelegramBotsApi\Types\EmojiType;
use RuntimeException;

/**
 * The theme with emoji placed on a background.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Emoji extends ChatShareTheme
{
    /**
     * @param EmojiType[] $emojis The emoji; 0-6 regular or custom emoji
     * @param int|null $background_backdrop_id Identifier of the backdrop used as the background; omitted if the
     *     default background is used. Use getChatShareThemeBackdrops() to get details about the backdrop.
     */
    public function __construct(
        public array $emojis,
        public ?int $background_backdrop_id = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'emoji';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong chat share theme type: {$data['type']}");
        }

        return new self(
            emojis: array_map(
                static fn(array $emojis_data) => EmojiType::makeByArray($emojis_data),
                $data['emojis'],
            ),
            background_backdrop_id: $data['background_backdrop_id'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'emojis' => $this->emojis,
            'background_backdrop_id' => $this->background_backdrop_id,
        ];
    }
}

