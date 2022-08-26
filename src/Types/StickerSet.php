<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

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
     * @param bool $is_animated <em>True</em>, if the sticker set contains <a
     *     href="https://telegram.org/blog/animated-stickers">animated stickers</a>
     * @param bool $is_video <em>True</em>, if the sticker set contains <a
     *     href="https://telegram.org/blog/video-stickers-better-reactions">video stickers</a>
     * @param bool $contains_masks <em>True</em>, if the sticker set contains masks
     * @param Sticker[] $stickers List of all set stickers
     * @param PhotoSize|null $thumb Sticker set thumbnail in the .WEBP, .TGS, or .WEBM format
     */
    public function __construct(
        public string $name,
        public string $title,
        public bool $is_animated,
        public bool $is_video,
        public bool $contains_masks,
        public array $stickers,
        public ?PhotoSize $thumb = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        $result = new self(
            name: $data['name'],
            title: $data['title'],
            is_animated: $data['is_animated'],
            is_video: $data['is_video'],
            contains_masks: $data['contains_masks'],
            stickers: [],
            thumb: isset($data['thumb'])
                ? PhotoSize::makeByArray($data['thumb'])
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
            'is_animated' => $this->is_animated,
            'is_video' => $this->is_video,
            'contains_masks' => $this->contains_masks,
            'stickers' => $this->stickers,
            'thumb' => $this->thumb,
        ];
    }
}
