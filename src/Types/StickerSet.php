<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use JetBrains\PhpStorm\Deprecated;
use Kuvardin\TelegramBotsApi\Enums\StickerType;
use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a sticker set.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class StickerSet extends Type
{
    /**
     * @param string $name Sticker set name
     * @param string $title Sticker set title
     * @param string $sticker_type_value Type of stickers in the set, currently one of Enums\StickerType::*->value
     * @param Sticker[] $stickers List of all set stickers
     * @param PhotoSize|null $thumbnail Sticker set thumbnail in the .WEBP, .TGS, or .WEBM format
     */
    public function __construct(
        public string $name,
        public string $title,
        public string $sticker_type_value,
        public array $stickers,

        #[Deprecated] public ?bool $is_animated = null,
        #[Deprecated] public ?bool $is_video = null,
        #[Deprecated] public ?PhotoSize $thumb = null,

        public ?PhotoSize $thumbnail = null,
    )
    {
        $this->thumb ??= $this->thumbnail;
        $this->thumbnail ??= $this->thumb;
    }

    public static function makeByArray(array $data): self
    {
        return new self(
            name: $data['name'],
            title: $data['title'],
            sticker_type_value: $data['sticker_type'],

            stickers: array_map(
                static fn(array $sticker_data) => Sticker::makeByArray($sticker_data),
                $data['stickers'],
            ),
            is_animated: $data['is_animated'] ?? null,

            is_video: $data['is_video'] ?? null,
            thumbnail: isset($data['thumbnail'])
                ? PhotoSize::makeByArray($data['thumbnail'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'sticker_type' => $this->sticker_type_value,
            'is_animated' => $this->is_animated,
            'is_video' => $this->is_video,
            'stickers' => $this->stickers,
            'thumbnail' => $this->thumbnail,
        ];
    }

    /**
     * @return StickerType|null Returns Null if the sticker type is unknown.
     */
    public function getStickerType(): ?StickerType
    {
        return StickerType::tryFrom($this->sticker_type_value);
    }
}
