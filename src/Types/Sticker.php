<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a sticker.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Sticker extends Type
{
    /**
     * @var string $file_id Identifier for this file, which can be used to download or reuse the file
     */
    public string $file_id;

    /**
     * @var string $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for
     *     different bots. Can't be used to download or reuse the file.
     */
    public string $file_unique_id;

    /**
     * @var int $width Sticker width
     */
    public int $width;

    /**
     * @var int $height Sticker height
     */
    public int $height;

    /**
     * @var bool $is_animated <em>True</em>, if the sticker is <a
     *     href="https://telegram.org/blog/animated-stickers">animated</a>
     */
    public bool $is_animated;

    /**
     * @var bool $is_video <em>True</em>, if the sticker is a <a
     *     href="https://telegram.org/blog/video-stickers-better-reactions">video sticker</a>
     */
    public bool $is_video;

    /**
     * @var PhotoSize|null $thumb Sticker thumbnail in the .WEBP or .JPG format
     */
    public ?PhotoSize $thumb = null;

    /**
     * @var string|null $emoji Emoji associated with the sticker
     */
    public ?string $emoji = null;

    /**
     * @var string|null $set_name Name of the sticker set to which the sticker belongs
     */
    public ?string $set_name = null;

    /**
     * @var MaskPosition|null $mask_position For mask stickers, the position where the mask should be placed
     */
    public ?MaskPosition $mask_position = null;

    /**
     * @var int|null $file_size File size in bytes
     */
    public ?int $file_size = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->file_id = $data['file_id'];
        $result->file_unique_id = $data['file_unique_id'];
        $result->width = $data['width'];
        $result->height = $data['height'];
        $result->is_animated = $data['is_animated'];
        $result->is_video = $data['is_video'];
        $result->thumb = isset($data['thumb'])
            ? PhotoSize::makeByArray($data['thumb'])
            : null;
        $result->emoji = $data['emoji'] ?? null;
        $result->set_name = $data['set_name'] ?? null;
        $result->mask_position = isset($data['mask_position'])
            ? MaskPosition::makeByArray($data['mask_position'])
            : null;
        $result->file_size = $data['file_size'] ?? null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'file_id' => $this->file_id,
            'file_unique_id' => $this->file_unique_id,
            'width' => $this->width,
            'height' => $this->height,
            'is_animated' => $this->is_animated,
            'is_video' => $this->is_video,
            'thumb' => $this->thumb,
            'emoji' => $this->emoji,
            'set_name' => $this->set_name,
            'mask_position' => $this->mask_position,
            'file_size' => $this->file_size,
        ];
    }
}
