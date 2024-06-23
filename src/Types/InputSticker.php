<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Enums\StickerFormat;
use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes a sticker to be added to a sticker set.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InputSticker extends Type
{
    /**
     * @param InputFile $sticker The added sticker. Animated and video stickers can't be uploaded via HTTP URL.
     * @param string[] $emoji_list List of 1-20 emoji associated with the sticker
     * @param string $format_value Format of the added sticker, must be one of Enums\StickerFormat::*->value
     * @param MaskPosition|null $mask_position Position where the mask should be placed on faces. For “mask” stickers
     *     only.
     * @param string[]|null $keywords List of 0-20 search keywords for the sticker with total length of up to
     *     64 characters. For “regular” and “custom_emoji” stickers only.
     */
    public function __construct(
        public InputFile $sticker,
        public array $emoji_list,
        public string $format_value,
        public ?MaskPosition $mask_position = null,
        public ?array $keywords = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            sticker: InputFile::makeByString($data['sticker']),
            emoji_list: $data['emoji_list'],
            format_value: $data['format'],
            mask_position: isset($data['mask_position'])
                ? MaskPosition::makeByArray($data['mask_position'])
                : null,
            keywords: $data['keywords'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'sticker' => $this->sticker,
            'format' => $this->format_value,
            'emoji_list' => $this->emoji_list,
            'mask_position' => $this->mask_position,
            'keywords' => $this->keywords,
        ];
    }

    public function getFormat(): ?StickerFormat
    {
        return StickerFormat::tryFrom($this->format_value);
    }
}
