<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this class represents a sticker.
 *
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Sticker implements TypeInterface
{
    /**
     * @var string Unique identifier for this file
     */
    public $file_id;

    /**
     * @var int Sticker width
     */
    public $width;

    /**
     * @var int Sticker height
     */
    public $height;

    /**
     * @var PhotoSize|null Sticker thumbnail in the .webp or .jpg format
     */
    public $thumb;

    /**
     * @var string|null Emoji associated with the sticker
     */
    public $emoji;

    /**
     * @var string|null Name of the sticker set to which the sticker belongs
     */
    public $set_name;

    /**
     * @var MaskPosition|null For mask stickers, the position where the mask should be placed
     */
    public $mask_position;

    /**
     * @var int|null File size
     */
    public $file_size;

    /**
     * Sticker constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->width = $data['width'];
        $this->height = $data['height'];

        if (isset($data['thumb'])) {
            $this->thumb = $data['thumb'] instanceof PhotoSize ? $data['thumb'] : new PhotoSize($data['thumb']);
        }

        $this->emoji = $data['emoji'] ?? null;
        $this->set_name = $data['set_name'] ?? null;

        if (isset($data['mask_position'])) {
            $this->mask_position = $data['mask_position'] instanceof MaskPosition ? $data['mask_position'] : new MaskPosition($data['mask_position']);
        }

        $this->file_size = $data['file_size'] ?? null;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'file_id' => $this->file_id,
            'width' => $this->width,
            'height' => $this->height,
            'thumb' => $this->thumb,
            'emoji' => $this->emoji,
            'set_name' => $this->set_name,
            'mask_position' => $this->mask_position,
            'file_size' => $this->file_size,

        ];
    }

    /**
     * @param string $file_id
     * @param int $width
     * @param int $height
     * @return Sticker
     * @throws Error
     */
    public static function make(string $file_id, int $width, int $height): self
    {
        return new self([
            'file_id' => $file_id,
            'width' => $width,
            'height' => $height,
        ]);
    }
}