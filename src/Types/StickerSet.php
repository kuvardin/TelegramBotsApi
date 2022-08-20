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
     * @var string $name Sticker set name
     */
    public string $name;

    /**
     * @var string $title Sticker set title
     */
    public string $title;

    /**
     * @var bool $is_animated <em>True</em>, if the sticker set contains <a
     *     href="https://telegram.org/blog/animated-stickers">animated stickers</a>
     */
    public bool $is_animated;

    /**
     * @var bool $is_video <em>True</em>, if the sticker set contains <a
     *     href="https://telegram.org/blog/video-stickers-better-reactions">video stickers</a>
     */
    public bool $is_video;

    /**
     * @var bool $contains_masks <em>True</em>, if the sticker set contains masks
     */
    public bool $contains_masks;

    /**
     * @var Sticker[] $stickers List of all set stickers
     */
    public array $stickers;

    /**
     * @var PhotoSize|null $thumb Sticker set thumbnail in the .WEBP, .TGS, or .WEBM format
     */
    public ?PhotoSize $thumb = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->name = $data['name'];
        $result->title = $data['title'];
        $result->is_animated = $data['is_animated'];
        $result->is_video = $data['is_video'];
        $result->contains_masks = $data['contains_masks'];
        $result->stickers = [];
        foreach ($data['stickers'] as $item_data) {
            $result->stickers[] = Sticker::makeByArray($item_data);
        }
        $result->thumb = isset($data['thumb'])
            ? PhotoSize::makeByArray($data['thumb'])
            : null;
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
