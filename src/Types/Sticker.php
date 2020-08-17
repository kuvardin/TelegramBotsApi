<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * This object represents a sticker.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Sticker implements TypeInterface
{
    /**
     * @var string Identifier for this file, which can be used to download or reuse the file
     */
    public string $file_id;

    /**
     * @var string Unique identifier for this file, which is supposed to be the same over time and for
     * different bots. Can't be used to download or reuse the file.
     */
    public string $file_unique_id;

    /**
     * @var int Sticker width
     */
    public int $width;

    /**
     * @var int Sticker height
     */
    public int $height;

    /**
     * @var bool True, if the sticker is animated
     */
    public bool $is_animated;

    /**
     * @var PhotoSize|null Sticker thumbnail in the .webp or .jpg format
     */
    public ?PhotoSize $thumb = null;

    /**
     * @var string|null Emoji associated with the sticker
     */
    public ?string $emoji = null;

    /**
     * @var string|null Name of the sticker set to which the sticker belongs
     */
    public ?string $set_name = null;

    /**
     * @var MaskPosition|null For mask stickers, the position where the mask should be placed
     */
    public ?MaskPosition $mask_position = null;

    /**
     * @var int|null File size
     */
    public ?int $file_size = null;

    /**
     * Sticker constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->file_unique_id = $data['file_unique_id'];
        $this->width = $data['width'];
        $this->height = $data['height'];
        $this->is_animated = $data['is_animated'];

        if (isset($data['thumb'])) {
            $this->thumb = $data['thumb'] instanceof PhotoSize
                ? $data['thumb']
                : new PhotoSize($data['thumb']);
        }

        if (isset($data['emoji'])) {
            $this->emoji = $data['emoji'];
        }

        if (isset($data['set_name'])) {
            $this->set_name = $data['set_name'];
        }

        if (isset($data['mask_position'])) {
            $this->mask_position = $data['mask_position'] instanceof MaskPosition
                ? $data['mask_position']
                : new MaskPosition($data['mask_position']);
        }

        if (isset($data['file_size'])) {
            $this->file_size = $data['file_size'];
        }
    }

    /**
     * @param string $file_id Identifier for this file, which can be used to download or reuse the file
     * @param string $file_unique_id Unique identifier for this file, which is supposed to be the same over time
     * and for different bots. Can't be used to download or reuse the file.
     * @param int $width Sticker width
     * @param int $height Sticker height
     * @param bool $is_animated True, if the sticker is animated
     * @return Sticker
     */
    public static function make(string $file_id, string $file_unique_id, int $width, int $height, bool $is_animated): self
    {
        return new self([
            'file_id' => $file_id,
            'file_unique_id' => $file_unique_id,
            'width' => $width,
            'height' => $height,
            'is_animated' => $is_animated,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'file_id' => $this->file_id,
            'file_unique_id' => $this->file_unique_id,
            'width' => $this->width,
            'height' => $this->height,
            'is_animated' => $this->is_animated,
            'thumb' => $this->thumb,
            'emoji' => $this->emoji,
            'set_name' => $this->set_name,
            'mask_position' => $this->mask_position,
            'file_size' => $this->file_size,
        ];
    }
}
