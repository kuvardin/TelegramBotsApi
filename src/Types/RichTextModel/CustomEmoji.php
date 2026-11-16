<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichTextModel;

use Kuvardin\TelegramBotsApi\Types\RichTextModel;
use RuntimeException;

/**
 * A custom emoji.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CustomEmoji extends RichTextModel
{
    /**
     * @param string $custom_emoji_id Unique identifier of the custom emoji. Use getCustomEmojiStickers() to get full
     *     information about the sticker.
     * @param string $alternative_text Alternative emoji for the custom emoji
     */
    public function __construct(
        public string $custom_emoji_id,
        public string $alternative_text,
    )
    {

    }

    public static function getType(): string
    {
        return 'custom_emoji';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich text type: {$data['type']}");
        }

        return new self(
            custom_emoji_id: $data['custom_emoji_id'],
            alternative_text: $data['alternative_text'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'custom_emoji_id' => $this->custom_emoji_id,
            'alternative_text' => $this->alternative_text,
        ];
    }
}

