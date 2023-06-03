<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

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
     * @deprecated Deprecated in v6.6. Use ->thumbnail instead
     */
    public ?PhotoSize $thumb = null;

    /**
     * @param string $name Sticker set name
     * @param string $title Sticker set title
     * @param string $sticker_type_value Type of stickers in the set, currently one of Enums\StickerType
     * @param bool $is_animated <em>True</em>, if the sticker set contains <a
     *     href="https://telegram.org/blog/animated-stickers">animated stickers</a>
     * @param bool $is_video <em>True</em>, if the sticker set contains <a
     *     href="https://telegram.org/blog/video-stickers-better-reactions">video stickers</a>
     * @param Sticker[] $stickers List of all set stickers
     * @param PhotoSize|null $thumbnail Sticker set thumbnail in the .WEBP, .TGS, or .WEBM format
     */
    public function __construct(
        public string $name,
        public string $title,
        public string $sticker_type_value,
        public bool $is_animated,
        public bool $is_video,
        public array $stickers,
        public ?PhotoSize $thumbnail = null,
    )
    {
        $this->thumb = $this->thumbnail;
    }

    public static function makeByArray(array $data): self
    {
        $result = new self(
            name: $data['name'],
            title: $data['title'],
            sticker_type_value: $data['sticker_type_value'],
            is_animated: $data['is_animated'],
            is_video: $data['is_video'],
            stickers: [],
            thumbnail: isset($data['thumbnail'])
                ? PhotoSize::makeByArray($data['thumbnail'])
                : null,
        );

        foreach ($data['stickers'] as $item_data) {
            $result->stickers[] = Sticker::makeByArray($item_data);
        }
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'sticker_type_value' => $this->sticker_type_value,
            'is_animated' => $this->is_animated,
            'is_video' => $this->is_video,
            'stickers' => $this->stickers,
            'thumbnail' => $this->thumbnail,
        ];
    }

    /**
     * @return StickerType|null Returns <em>Null</em> if the sticker type is unknown.
     */
    public function getStickerType(): ?StickerType
    {
        return StickerType::tryFrom($this->sticker_type_value);
    }
}
