<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * This object represents one size of a photo or a file / sticker thumbnail.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PhotoSize extends FileAbstract
{
    /**
     * @param string $file_id Identifier for this file, which can be used to download or reuse the file
     * @param string $file_unique_id Unique identifier for this file, which is supposed to be the same over time and
     *     for different bots. Can't be used to download or reuse the file.
     * @param int $width Photo width
     * @param int $height Photo height
     * @param int|null $file_size File size in bytes
     */
    public function __construct(
        string $file_id,
        string $file_unique_id,
        public int $width,
        public int $height,
        ?int $file_size = null,
    )
    {
        $this->file_id = $file_id;
        $this->file_unique_id = $file_unique_id;
        $this->file_size = $file_size;
    }

    public static function makeByArray(array $data): self
    {
        return new self(
            file_id: $data['file_id'],
            file_unique_id: $data['file_unique_id'],
            width: $data['width'],
            height: $data['height'],
            file_size: $data['file_size'] ?? null,
        );
    }

    public function getRequestData(): array
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
