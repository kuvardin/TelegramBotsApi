<?php

declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * This object represents a sticker set.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class StickerSet implements TypeInterface
{
    /**
     * @var string Sticker set name
     */
    public string $name;

    /**
     * @var string Sticker set title
     */
    public string $title;

    /**
     * @var bool True, if the sticker set contains animated stickers
     */
    public bool $is_animated;

    /**
     * @var bool True, if the sticker set contains masks
     */
    public bool $contains_masks;

    /**
     * @var Sticker[] List of all set stickers
     */
    public array $stickers = [];

    /**
     * StickerSet constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->title = $data['title'];
        $this->is_animated = $data['is_animated'];
        $this->contains_masks = $data['contains_masks'];

        foreach ($data['stickers'] as $item) {
            $this->stickers[] = $item instanceof Sticker ? $item : new Sticker($item);
        }
    }

    /**
     * @param string $name Sticker set name
     * @param string $title Sticker set title
     * @param bool $is_animated True, if the sticker set contains animated stickers
     * @param bool $contains_masks True, if the sticker set contains masks
     * @param Sticker[] $stickers List of all set stickers
     * @return StickerSet
     * @throws Error
     */
    public static function make(string $name, string $title, bool $is_animated, bool $contains_masks, array $stickers): self
    {
        return new self([
            'name' => $name,
            'title' => $title,
            'is_animated' => $is_animated,
            'contains_masks' => $contains_masks,
            'stickers' => $stickers,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'is_animated' => $this->is_animated,
            'contains_masks' => $this->contains_masks,
            'stickers' => $this->stickers,
        ];
    }
}
