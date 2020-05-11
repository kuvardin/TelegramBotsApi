<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * This object represents one size of a photo or a file / sticker thumbnail.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PhotoSize implements TypeInterface
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
     * @var int Photo width
     */
    public int $width;

    /**
     * @var int Photo height
     */
    public int $height;

    /**
     * @var int|null File size
     */
    public ?int $file_size = null;

    /**
     * PhotoSize constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file_id = $data['file_id'];
        $this->file_unique_id = $data['file_unique_id'];
        $this->width = $data['width'];
        $this->height = $data['height'];

        if (isset($data['file_size'])) {
            $this->file_size = $data['file_size'];
        }
    }

    /**
     * @param string $file_id Identifier for this file, which can be used to download or reuse the file
     * @param string $file_unique_id Unique identifier for this file, which is supposed to be the same over
     * time and for different bots. Can't be used to download or reuse the file.
     * @param int $width Photo width
     * @param int $height Photo height
     * @return PhotoSize
     */
    public static function make(string $file_id, string $file_unique_id, int $width, int $height): self
    {
        return new self([
            'file_id' => $file_id,
            'file_unique_id' => $file_unique_id,
            'width' => $width,
            'height' => $height,
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
            'file_size' => $this->file_size,
        ];
    }
}
